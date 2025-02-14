<?php

namespace App\Http\Controllers\DeliveryMan\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        $guard = 'delivery_man'; // Set the guard name for delivery_man users

        if ($request->user($guard)->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::DELIVERYMAN);
        }

        // Replace 'delivery_man' with your actual guard provider name
        $request->user($guard)->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
