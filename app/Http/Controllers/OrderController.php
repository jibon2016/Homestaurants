<?php

namespace App\Http\Controllers;

//use App\Http\Requests\OrderRequest;
use Stripe\Stripe;
use App\Models\Cart;
use App\Models\User;
use Stripe\Customer;
use App\Models\Order;
use App\Models\Vendor;
use App\Models\OrderItem;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewOrderNotification;

class OrderController extends Controller
{
    public function orderForm(){
        $user_id = auth()->user()->id;
        $customer_details = User::where('id', $user_id)->first();
        //dd($customer_details);
        // $cartItems = Cart::where('user_id', $user_id)->get();
        //dd($cartItems);
        $cartItems = Cart::where('user_id', $user_id)
        ->join('foods', 'carts.food_id', '=', 'foods.id')
        ->get(['carts.*', 'foods.vendor_id']); // Fetch the vendor_id from the foods table
        //dd($cartItems);

        $user_location = DB::table('user_locations')->where('user_id', $user_id)->first();
        //dd($user_location);

        $groupedCartItems = $cartItems->groupBy('vendor_id');
        //dd($groupedCartItems);
        $totalDeliveryCharge = 0;
        $totalPrice = 0;
        $vendor = null;

        foreach ($groupedCartItems as $vendorId => $cartItems) {
            $vendor = Vendor::find($vendorId);
            //dd($vendor);
            //dd($customer_details);
            $vendorDistance = haversineDistance($vendor->vendor_latitude, $vendor->vendor_longitude, $user_location->latitude, $user_location->longitude);
            // Use haversine distance calculation method
            //dd($vendor->vendor_latitude);
            //dd($vendorDistance);
            $vendorDeliveryCharge = 0;
            $vendorTotalPrice = 0;

            foreach ($cartItems as $cartItem) {
                // Check if the delivery charge is null and set it to 0.00 if it is
                $deliveryChargeRate = $vendor->deliveryCharge->charge ?? 0.00;
                // Calculate delivery charge for each cart item based on vendor's criteria (e.g., delivery charge rate, quantity)
                $deliveryCharge = $deliveryChargeRate * $vendorDistance * 1 /*$cartItem->quantity*/;
                $vendorDeliveryCharge += $deliveryCharge;
                //dd($vendorDeliveryCharge);
                //dd($vendor->deliveryCharge->charge);

                // Calculate the total price for each cart item
                $foodPrice = $cartItem->food->final_price;
                $itemTotalPrice = $foodPrice * $cartItem->quantity;
                $vendorTotalPrice += $itemTotalPrice;
            }

            $totalDeliveryCharge += $vendorDeliveryCharge;
            $totalDeliveryCharge = number_format($totalDeliveryCharge, 2);
            $totalPrice += $vendorTotalPrice;

        }

        //dd($totalDeliveryCharge);
        return view('order-form', [
            'totalDeliveryCharge' => $totalDeliveryCharge,
            'customerDetails' => $customer_details,
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
            'groupedCartItems' => $groupedCartItems,
            'vendor' => $vendor,
        ]);
    }

    // Confirm order with payment
    // Send data to pivot table (order_items) using laravel relationship

    public function confirmOrder(Request $request) {
        $formFields = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|numeric',
            'delivery_address' => 'nullable|string|max:255',
            //'delivery_option' => 'required|in:delivery,pickup',
            'delivery_option' => 'required',
            'expected_receive_time' => 'required',
            'payment_method' => 'required',
            'total_price' => 'required',
            'payment_intent_id' => 'required_if:payment_method,stripe',
            'paymentID' => 'nullable',
            'trxID'=> 'nullable',
            // pass condition inside validation rule
        ]);

       $formFields['user_id'] = auth()->user()->id;

       // Get the total price from the form input field
       $totalPrice = $request->input('total_price');
       // get the currency
       $cartItems = $this->orderForm()->cartItems;

       /**
        * Stripe payment gateway integration
        */
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Create an empty variable for the payment intent ID
        $paymentIntentId = null;

        $clientSecret = null;

        // if ($request->payment_method === 'stripe') {

        //     // Assuming you have collected the payment method ID and customer ID or email from the request
        //     $paymentMethodId = $request->payment_intent_id;

        //     // Create a Payment Intent
        //     $paymentIntent = PaymentIntent::create([
        //         'amount' => $totalPrice * 100, // Total amount in cents
        //         'payment_method' => $paymentMethodId,
        //         'currency' => $cartItems->first()->food->currency, // Replace with your desired currency
        //         'customer' => auth()->user()->email,
        //     ]);

        //     // Retrieve the client secret from the Payment Intent
        //     $clientSecret = $paymentIntent->client_secret;

        //     // Set the payment intent ID
        //     $paymentIntentId = $paymentIntent->id;
        // }


if ($request->payment_method === 'stripe') {
    // Assuming you have collected the payment method ID from the request
    $paymentMethodId = $request->payment_intent_id;

    // Get the customer's email address
    $customerEmail = auth()->user()->email;

    // Check if the customer already exists in Stripe
    try {
        $stripeCustomer = Customer::retrieve(['email' => $customerEmail]);
        $customerId = $stripeCustomer->id;
    } catch (\Exception $e) {
        // If the customer does not exist, create a new customer in Stripe
        $stripeCustomer = Customer::create([
            'email' => $customerEmail,
            // You can also include additional customer information here if needed
        ]);
        $customerId = $stripeCustomer->id;
    }

    // Create a Payment Intent with the customer's email address
    $paymentIntent = PaymentIntent::create([
        'amount' => $totalPrice * 100, // Total amount in cents
        'payment_method' => $paymentMethodId,
        'currency' => 'usd', // Replace with your desired currency
        'customer' => $customerId, // Associate Payment Intent with the customer
    ]);

    // Retrieve the client secret from the Payment Intent
    $clientSecret = $paymentIntent->client_secret;

    // Set the payment intent ID
    $paymentIntentId = $paymentIntent->id;
}


        // if ($request->payment_method === 'stripe') {
        //     // Determine the currency of the product
        //     $productCurrency = $cartItems->first()->food->currency;

        //     // Define conversion rates for Euro (EUR) and Swiss Franc (CHF) to USD
        //     $conversionRates = [
        //         'EUR' => 1.18, // Example conversion rate: 1 EUR = 1.18 USD
        //         'CHF' => 1.10, // Example conversion rate: 1 CHF = 1.10 USD
        //         'BDT' => 0.012, // Example conversion rate: 1 BDT = 0.012 USD
        //     ];

        //     // Convert the total price to USD if it's not already in USD
        //     if ($productCurrency !== 'usd') {
        //         // Check if the conversion rate is available for the product currency
        //         if (isset($conversionRates[$productCurrency])) {
        //             // Convert the total price to USD using the conversion rate and round to the nearest integer
        //             $totalPrice = round($totalPrice * $conversionRates[$productCurrency]);
        //         } else {
        //             // Conversion rate not available for the product currency
        //             return response()->json(['error' => 'Conversion rate not available for the product currency.'], 500);
        //         }
        //     }

        //     // Create a Payment Intent with the total price in USD
        //     $paymentIntent = PaymentIntent::create([
        //         'amount' => $totalPrice * 100, // Total amount in cents
        //         'currency' => 'usd', // Set currency explicitly to USD
        //     ]);

        //     // Retrieve the client secret from the Payment Intent
        //     $clientSecret = $paymentIntent->client_secret;

        //     // Set the payment intent ID
        //     $paymentIntentId = $paymentIntent->id;
        // }



        // Create the order
        $order = Order::create($formFields + ['payment_intent_id' => $paymentIntentId]);
        //dd('Order created successfully!');

       //dd('Order created successfully!');

       //dd($this->orderForm()->totalPrice);
       // collect data from orderForm function inside same class
       $cart_items = $this->orderForm()->cartItems;
       //dd($cart_items);
       $grouped_cart_items = $this->orderForm()->groupedCartItems;
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
//                'earn_price' => $cartItem->food->final_price * $cartItem->quantity * 0.90,
                'earn_price' => 0,
                'order_status' => 'Pending',
                'currency' => $cartItem->food->currency,
                'delivery_option' => $order->delivery_option,
                'payment_method' => $order->payment_method,
                'request_message' => $cartItem->request_message,
            ]);
        }

        // $vendor = Vendor::find($vendor_id);
        // dd($vendor);

        // Notify the vendor about the new order
        if ($vendor) {
            $vendor->notify(new NewOrderNotification($order));
        }

       }

       // Delete the cart items associated with the user
       Cart::where('user_id', auth()->user()->id)->delete();

       //dd($paymentIntentId);

       return redirect()->route('order-success')->with('success', 'You have placed your order successfully!');

    }

}
