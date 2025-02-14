<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsVerifyDelmEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (!Auth::guard('delivery_man')->user()->is_email_verified) {
        //     auth()->logout();
        //     return redirect()->route('delm.login')
        //     ->with('message', 'You need to confirm your account. We have sent you an activation link, please check your email.');
        //     }
        //     return $next($request);
        $user = Auth::guard('delivery_man')->user();

        if (!$user || !$user->is_email_verified) {
            auth()->logout();
            return redirect()->route('delm.verification.resend');
        }

        return $next($request);
    }
}
