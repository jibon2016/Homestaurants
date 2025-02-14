<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Vendor;
use App\Notifications\NewOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Karim007\LaravelBkashTokenize\Facade\BkashPaymentTokenize;
use Karim007\LaravelBkashTokenize\Facade\BkashRefundTokenize;

class BkashTokenizePaymentController extends Controller
{
    public function index()
    {
        return view('bkashT::bkash-payment');
    }
    public function createPayment(Request $request, $price, $id=null)
    {
        $inv = uniqid();
        $request['intent'] = 'sale';
        $request['mode'] = '0011'; //0011 for checkout
        $request['payerReference'] = $inv;
        $request['currency'] = 'BDT';
        $request['amount'] = $price;
        $request['merchantInvoiceNumber'] = $inv;
        $request['callbackURL'] = config("bkash.callbackURL");;

        // Store necessary data in session
        session()->put('payment_data', [
            'customer_name' => $request->input('customer_name'),
            'customer_phone' => $request->input('customer_phone'),
            'delivery_address' => $request->input('delivery_address'),
            'delivery_option' => $request->input('delivery_option'),
            'expected_receive_time' => $request->input('expected_receive_time'),
            'payment_method' => $request->input('payment_method'),
            'total_price' => $price, // Pass the price directly
            // Add any other data you need for the callback
        ]);

         //If $id is provided, store it in session as well
        if ($id !== null) {
            session()->put('order_id', $id);
        }

        $request_data_json = json_encode($request->all());

        $response =  BkashPaymentTokenize::cPayment($request_data_json);
        //$response =  BkashPaymentTokenize::cPayment($request_data_json,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..

        //store paymentID and your account number for matching in callback request
        //dd($response); //if you are using sandbox and not submit info to bkash use it for 1 response

        if (isset($response['bkashURL'])) return redirect()->away($response['bkashURL']);
        else return redirect()->back()->with('error-alert2', $response['statusMessage']);
    }

    public function callBack(Request $request)
    {
        if ($request->status == 'success') {
            $response = BkashPaymentTokenize::executePayment($request->paymentID);

            if (!$response) {
                $response = BkashPaymentTokenize::queryPayment($request->paymentID);
            }

            if (isset($response['statusCode']) && $response['statusCode'] == "0000" && $response['transactionStatus'] == "Completed") {
                   // Retrieve data from session
            $paymentData = session()->get('payment_data');

            // Check if payment status is 'pending'
            $orderId = session()->get('order_id');
            //dd($orderId);
            $order = Order::findOrFail($orderId);
            if ($order != null && $order->payment_method == 'cash') {
                // Update the order based on order ID
                $order->payment_status = 'paid';
                $order->payment_method = 'bkash';
                $order->paymentID = $request->paymentID;
                $order->trxID = $request->trxID;
                $order->save();
            } else {
                 // Create the order
            $order = Order::create($paymentData + [
                //'payment_intent_id' => $request->paymentID,
                'paymentID' => $request->paymentID,
                'trxID' => $request->trxID,
                'user_id' => auth()->user()->id,
                'payment_status' => 'paid',
            ]);
            }

            $cartItems = Cart::where('user_id', auth()->user()->id)
            ->join('foods', 'carts.food_id', '=', 'foods.id')
            ->get(['carts.*', 'foods.vendor_id']);

            $groupedCartItems = $cartItems->groupBy('vendor_id');
       //dd($cart_items);
       $grouped_cart_items = $groupedCartItems;
       //dd($grouped_cart_items);

       foreach($grouped_cart_items as $vendor_id => $cart_items){

        $vendor = Vendor::find($vendor_id);
        //dd($vendor);
        //dd($customer_details);
        $user_id = auth()->user()->id;
        $user_location = DB::table('user_locations')->where('user_id', $user_id)->first();
        //dd($user_location);
        $vendorDistance = haversineDistance($vendor->vendor_latitude, $vendor->vendor_longitude, $user_location->latitude, $user_location->longitude);

        foreach($cart_items as $cartItem){

            $food = $cartItem->food;
            // Update the available_quantity in the foods table
            $newAvailableQuantity = $food->available_quantity - $cartItem->quantity;

            // Update the food's available_quantity field
            $food->available_quantity = $newAvailableQuantity;
            $food->save();

            OrderItem::create([
                'order_id' => $order->id,
                'vendor_id' => $vendor_id,
                'food_id' => $cartItem->food_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->food->final_price * $cartItem->quantity,
                'delivery_men_id' => null, // If applicable, provide the delivery men ID
                //'delivery_charge' => $cartItem->food->vendor->deliveryCharge->charge * $vendorDistance * $cartItem->quantity,
                'delivery_charge' => $cartItem->food->vendor->deliveryCharge->charge * $vendorDistance,
                'earn_price' => $cartItem->food->final_price * $cartItem->quantity * 0.90,
                'order_status' => 'pending',
                'currency' => $cartItem->food->currency,
                'delivery_option' => $order->delivery_option,
                'payment_method' => $order->payment_method,
                'request_message' => $cartItem->request_message,
            ]);
                }

                // Notify the vendor about the new order
                if ($vendor) {
                    $vendor->notify(new NewOrderNotification($order));
                }
            }

                // Delete the cart items associated with the user
                Cart::where('user_id', auth()->user()->id)->delete();

                // Redirect to the thank you page
                return redirect()->route('order-success');
            }
            return BkashPaymentTokenize::failure($response['statusMessage']);
        } elseif ($request->status == 'cancel') {
            return BkashPaymentTokenize::cancel('Your payment is canceled');
        } else {
            return BkashPaymentTokenize::failure('Your transaction is failed');
        }
    }

    public function searchTnx($trxID)
    {
        //response
        return BkashPaymentTokenize::searchTransaction($trxID);
        //return BkashPaymentTokenize::searchTransaction($trxID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }

    public function refund(Request $request)
    {
        $paymentID='Your payment id';
        $trxID='your transaction no';
        $amount=5;
        $reason='this is test reason';
        $sku='abc';
        //response
        return BkashRefundTokenize::refund($paymentID,$trxID,$amount,$reason,$sku);
        //return BkashRefundTokenize::refund($paymentID,$trxID,$amount,$reason,$sku, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }
    public function refundStatus(Request $request)
    {
        $paymentID='Your payment id';
        $trxID='your transaction no';
        return BkashRefundTokenize::refundStatus($paymentID,$trxID);
        //return BkashRefundTokenize::refundStatus($paymentID,$trxID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }

}
