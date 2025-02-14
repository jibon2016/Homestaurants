<?php

namespace App\Http\Controllers\DeliveryMan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Vendor;
use App\Notifications\AcceptOrDenyNotification;

class MangeOrderController extends Controller
{
    // Total receive orders
    public function orders() {
        $delmId = Auth::guard('delivery_man')->user()->id;
        $orders = OrderItem::where('delivery_men_id', $delmId)->with('order')->latest()->paginate(6);
        //dd($orders);
        $countOrders = OrderItem::where('delivery_men_id', $delmId)->get()->count();
        //dd($countOrders);
        return view('delm.orders', compact('orders', 'countOrders'));
    }

    public function editOrder(OrderItem $orderItem)
    {
        return view('delm.edit-order', compact('orderItem'));
    }

    public function acceptOrDenyOrder(OrderItem $orderItem, Request $request) {
        $formFields = $request->validate([
            'delm_response' => ['required'],
        ]);

        //dd($formFields);

        $orderItem->update($formFields);

        // Get the associated user and vendor
        $vendor = Vendor::findOrFail($orderItem->vendor_id);
        //dd($vendor);
        //$vendor = Vendor::findOrFail($orderItem->order->vendor_id);

        // Dispatch notification for the user
        if ($vendor) {
            $vendor->notify(new AcceptOrDenyNotification($orderItem));
        }

        // // Dispatch notification for the vendor
        // if ($vendor) {
        //     $vendor->notify(new OrderStatusByDelmNotification($orderItem));
        // }

        return redirect()->route('delm.orders')->with('success', 'Order Updated Successfully!');
    }

}
