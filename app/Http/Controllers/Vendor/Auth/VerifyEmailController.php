<?php

namespace App\Http\Controllers\Vendor\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\Auth\EmailVerificationRequest as AuthEmailVerificationRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(AuthEmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user('vendor')->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::VENDOR.'?verified=1');
        }

        if ($request->user('vendor')->markEmailAsVerified()) {
            event(new Verified($request->user('vendor')));
        }

        return redirect()->intended(RouteServiceProvider::VENDOR.'?verified=1');
    }
}
