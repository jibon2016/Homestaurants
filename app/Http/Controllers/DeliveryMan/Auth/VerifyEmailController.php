<?php

namespace App\Http\Controllers\DeliveryMan\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $guard = 'delivery_man'; // Set the guard name for delivery_man users

        if ($request->user($guard)->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::DELIVERYMAN.'?verified=1');
        }

        if ($request->user($guard)->markEmailAsVerified()) {
            event(new Verified($request->user($guard)));
        }

        return redirect()->intended(RouteServiceProvider::DELIVERYMAN.'?verified=1');
    }
}
