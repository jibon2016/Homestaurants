<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{

    public function index()
    {
        $userId = Auth::guard('web')->id();

        $notifications = DB::table('notifications')
            ->where('notifiable_id', $userId)
            ->where('notifiable_type', 'App\Models\User')
            ->orderBy('created_at', 'desc')
            ->get();

        //dd($notifications);

        return view('notifications', compact('notifications'));
    }

    public function markAsRead(Request $request)
    {
        $notificationId = $request->input('notification_id');
        $notification = Auth::guard('web')->user()->notifications()->findOrFail($notificationId);
        $notification->markAsRead();

        return redirect()->back();
    }

    public function markAsUnread(Request $request)
    {
        $notificationId = $request->input('notification_id');
        $notification = Auth::guard('web')->user()->notifications()->findOrFail($notificationId);
        $notification->markAsUnread();

        return redirect()->back();
    }
}
