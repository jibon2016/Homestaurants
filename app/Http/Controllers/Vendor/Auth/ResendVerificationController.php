<?php
namespace App\Http\Controllers\Vendor\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VendorVerificationEmail;
use App\Models\Vendor;
use App\Models\VendorVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ResendVerificationController extends Controller
{
    public function show()
    {
        return view('vendor.auth.resend-verification');
    }

    public function resend(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        $vendor = Vendor::where('email', $request->email)->first();

        if (!$vendor) {
            return redirect()->route('vendor.verification.resend')->with('message', 'Vendor not found.');
        }

        if (!$vendor->is_email_verified) {
            $token = Str::random(64);
            $verifyUser = VendorVerify::updateOrCreate(
                ['vendor_id' => $vendor->id],
                ['token' => $token]
            );

            Mail::to($vendor->email)->send(new VendorVerificationEmail($token, $vendor));

            return redirect()->route('vendor.verification.resend')->with('message', 'A verification email has been resent. Please check your email to verify your account.');
        }

        return redirect()->route('vendor.dashboard')->with('message', 'Your email is already verified.');
    }
}
