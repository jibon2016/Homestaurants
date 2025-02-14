<?php

namespace App\Http\Controllers\Vendor\Auth;

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
        $guard = 'vendor'; // Set the guard name for vendor users

        if ($request->user($guard)->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::VENDOR);
        }

        // Replace 'vendor' with your actual guard provider name
        $request->user($guard)->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
