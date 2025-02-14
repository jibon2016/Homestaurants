<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{

    // public function index()
    // {

    //     // $notifications = Auth::guard('vendor')->user()->notifications;
    //     $vendor = Auth::guard('vendor')->user(); // Assuming you're using the Vendor model for authentication
    //     //dd($vendor);

    //     $notifications = $vendor->notifications;

    //     dd($notifications);

    //     return view('vendors.notifications', compact('notifications'));
    // }

    public function index()
    {
        $vendorId = Auth::guard('vendor')->id();

        $notifications = DB::table('notifications')
            ->where('notifiable_id', $vendorId)
            ->where('notifiable_type', 'App\Models\Vendor')
            ->orderBy('created_at', 'desc')
            ->get();

        //dd($notifications);

        return view('vendors.notifications', compact('notifications'));
    }

    public function markAsRead(Request $request)
    {
        $notificationId = $request->input('notification_id');
        $notification = Auth::guard('vendor')->user()->notifications()->findOrFail($notificationId);
        $notification->markAsRead();

        return redirect()->back();
    }

    public function markAsUnread(Request $request)
    {
        $notificationId = $request->input('notification_id');
        $notification = Auth::guard('vendor')->user()->notifications()->findOrFail($notificationId);
        $notification->markAsUnread();

        return redirect()->back();
    }
}
