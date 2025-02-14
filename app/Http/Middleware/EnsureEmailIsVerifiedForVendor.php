<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerifiedForVendor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        //dd(auth()->guard('vendor')->user() instanceof MustVerifyEmail);
        if (
            !$request->user($guard) ||
            ($request->user($guard) instanceof MustVerifyEmail && !$request->user($guard)->hasVerifiedEmail())
        ) {
            if ($request->expectsJson()) {
                return abort(403, 'Your email address is not verified.');
            } else {
                // Redirect to the custom URL "/vendor/verify-email"
                return redirect('/vendor/verify-email');
            }
        }

        return $next($request);
    }

}
