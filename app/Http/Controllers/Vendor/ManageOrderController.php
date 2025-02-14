<?php

namespace App\Http\Controllers\Vendor;

use App\Models\User;
use App\Models\Vendor;
use App\Models\OrderItem;
use App\Models\DeliveryMan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Notification;
use App\Notifications\DeliveryManAssignNotification;
use App\Notifications\OrderStatusUpdatedNotification;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ManageOrderController extends Controller
{
    // Total receive orders
    public function orders() {
        $vendorId = Auth::guard('vendor')->user()->id;
        $orders = OrderItem::where('vendor_id', $vendorId)->with('order')->latest()->paginate(6);
        //dd($orders);
        $countOrders = OrderItem::where('vendor_id', $vendorId)->get()->count();
        //dd($countOrders);
        // Detect user details

        // foreach ($orders as $order){
        //     $customerId = $order->order->user_id;
        //     //dd($customerId);
        //     $customerDetails = User::findOrFail($customerId);
        //     //dd($customerDetails);
        // }
        // //dd($customerDetails->email);
        return view('vendors.orders', compact('orders', 'countOrders'));
    }

    public function editOrder(OrderItem $orderItem){
        //dd($orderItem);
        $vendorId = Auth::guard('vendor')->user()->id;
        $vendor = Vendor::findOrFail($vendorId);
        $vendorLatitude = $vendor->vendor_latitude;
        $vendorLongitude = $vendor->vendor_longitude;
        $latLng = $vendorLatitude . ',' . $vendorLongitude;
        $radius = 50; // Set your desired radius value here

        // When required multiple pagination in the same page
        $nearbyDeliveryMen = DeliveryMan::nearby($latLng, $radius)->get();
        //return dd($nearbyDeliveryMen);
        $delmCount = DeliveryMan::nearby($latLng, $radius)->get()->count();
        //dd($delmCount);

        return view('vendors.edit-order', compact('nearbyDeliveryMen', 'delmCount', 'orderItem'));
    }

    public function updateOrder(OrderItem $orderItem, Request $request) {
        $formFields = $request->validate([
            'order_status' => ['required'],
            'delivery_men_id' => ['nullable'],
        ]);

        $orderItem->update($formFields);

        // Dispatch the notification after updating the order_status
        // Get the associated user
        $user = User::findOrFail($orderItem->order->user_id);

        if ($user) {
            $user->notify(new OrderStatusUpdatedNotification($orderItem));
        }

        // Check if a delivery man is assigned and send notification to the delivery man
        if (!is_null($orderItem->delivery_men_id)) {
            try {
                $deliveryMan = DeliveryMan::findOrFail($orderItem->delivery_men_id);
                $deliveryMan->notify(new DeliveryManAssignNotification($orderItem));
            } catch (ModelNotFoundException $e) {
                // Handle the case where the delivery man is not found
                // You can log an error or take other appropriate action
            }
        }

        return redirect()->route('vendor.orders')->with('success', 'Order Updated Successfully!');
    }

}
