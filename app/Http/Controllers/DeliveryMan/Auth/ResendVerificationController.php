<?php
namespace App\Http\Controllers\DeliveryMan\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerificationEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\DeliveryManVerify;
use Illuminate\Support\Facades\Auth;

class ResendVerificationController extends Controller
{
    public function show()
    {
        return view('delm.auth.resend-verification');
    }

    public function resend(Request $request)
    {
        $user = auth()->guard('delivery_man')->user();
        //dd($user);
        if (!$user->is_email_verified) {
            $token = Str::random(64);
            $verifyUser = DeliveryManVerify::create([
                'delivery_man_id' => $user->id,
                'token' => $token,
            ]);

            Mail::to($user->email)->send(new VerificationEmail($token, $user));

            return redirect()->route('delm.verification.resend')->with('message', 'A verification email has been resent. Please check your email to verify your account.');
        }

        return redirect()->route('delm.dashboard')->with('message', 'Your email is already verified.');
    }
}
