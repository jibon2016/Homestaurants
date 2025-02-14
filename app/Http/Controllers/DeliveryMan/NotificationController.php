<?php

namespace App\Http\Controllers\DeliveryMan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{

    public function index()
    {
        $delmId = Auth::guard('delivery_man')->id();

        $notifications = DB::table('notifications')
            ->where('notifiable_id', $delmId)
            ->where('notifiable_type', 'App\Models\DeliveryMan')
            ->orderBy('created_at', 'desc')
            ->get();

        //dd($notifications);

        return view('delm.notifications', compact('notifications'));
    }

    public function markAsRead(Request $request)
    {
        $notificationId = $request->input('notification_id');
        $notification = Auth::guard('delivery_man')->user()->notifications()->findOrFail($notificationId);
        $notification->markAsRead();

        return redirect()->back();
    }

    public function markAsUnread(Request $request)
    {
        $notificationId = $request->input('notification_id');
        $notification = Auth::guard('delivery_man')->user()->notifications()->findOrFail($notificationId);
        $notification->markAsUnread();

        return redirect()->back();
    }
}
