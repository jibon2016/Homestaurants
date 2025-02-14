<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Rating;
use Illuminate\Http\Request;

class CustomerOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function ordersByCustomer()
    {
        $userId = auth()->user()->id;

        // Fetch all orders for the authenticated user
        $fullOrders = Order::where('user_id', $userId)->latest()->paginate(5);

        // Get the IDs of all orders for the authenticated user
        $orderIds = $fullOrders->pluck('id');

        // Fetch all order items related to the retrieved order IDs
        $orderItems = OrderItem::whereIn('order_id', $orderIds)->latest()->get();

        // Organize the order items by their order IDs
        $groupedOrderItems = $orderItems->groupBy('order_id');


        return view('customer-orders', [
            'fullOrders' => $fullOrders,
            'groupedOrderItems' => $groupedOrderItems,
        ]);
    }

    public function ratingsForm ($orderItemId) {
        $orderItemId = OrderItem::findOrFail($orderItemId);
        //dd($orderItemId);
        $userId = auth()->user()->id;
        $ratingByUser = Rating::where('user_id', $userId)->where('order_item_id', $orderItemId->id)->first();

        //dd($orderItemId->id);

        return view('rating-form', ['orderItemId'=> $orderItemId, 'ratingByUser' => $ratingByUser]);
        // Generated errors when call compact() method
    }

    public function createOrUpdateRating(Request $request, $orderItemId){

        $userId = auth()->user()->id;
        $orderItemId = OrderItem::findOrFail($orderItemId);
        $ratingByUser = Rating::where('user_id', $userId)->where('order_item_id', $orderItemId->id)->first();
        //dd($ratingByUser);

        $formFileds = $request->validate([
            'rating' => 'required',
            'comment' => 'nullable',
            'drating' => 'nullable',
            'dcomment' => 'nullable',
        ]);

        $formFileds['user_id'] = $userId;
        $formFileds['order_item_id'] = $orderItemId->id;
        $formFileds['food_id'] = $orderItemId->food_id;
        $formFileds['vendor_id'] = $orderItemId->vendor_id;
        $formFileds['delivery_man_id'] = $orderItemId->delivery_men_id;

        if ($ratingByUser === NULL) {
            Rating::create($formFileds);
        }else {
            $ratingByUser->update($formFileds);
        }
        return redirect()->route('customer.orders')->with('success', 'Thanks for you rating and opinion!');
    }

}
