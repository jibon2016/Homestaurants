<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class EnsureEmailIsVerifiedForDeliveryMen
{/**
     * Specify the redirect route for the middleware.
     *
     * @param  string  $route
     * @return string
     */
    public static function redirectTo($route)
    {
        return static::class.':'.$route;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $redirectToRoute
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|null
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        //dd(auth()->guard('delivery_man')->user() instanceof MustVerifyEmail);
        if (
            !$request->user($guard) ||
            ($request->user($guard) instanceof MustVerifyEmail && !$request->user($guard)->hasVerifiedEmail())
        ) {
            if ($request->expectsJson()) {
                return abort(403, 'Your email address is not verified.');
            } else {
                // Redirect to the custom URL "/vendor/verify-email"
                return redirect('/delivery-man/verify-email');
            }
        }

        return $next($request);
    }
}
