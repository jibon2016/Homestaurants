<?php

namespace App\Http\Controllers\DeliveryMan\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptControllerForDeliveryMan extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        //$guard = 'delivery_man'; // Set the guard name for delivery_man users

        return $request->user('delivery_man')->hasVerifiedEmail()
            ? redirect()->intended(RouteServiceProvider::DELIVERYMAN)
            : view('delm.auth.verify-email');
    }
}
