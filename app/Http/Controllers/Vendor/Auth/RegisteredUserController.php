<?php

namespace App\Http\Controllers\Vendor\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VendorVerificationEmail;
use App\Models\Vendor;
use App\Models\VendorVerify;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('vendor.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Vendor::class],
            'phone' => ['required', 'string', 'min:9', 'max:14', 'unique:vendors'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'vendor_name' => ['required', 'string', 'max:255', 'unique:'.Vendor::class],
            'country' => ['required', 'string', 'max:255'],
            'currency' => ['required', 'string', 'max:255'],
            'vendor_address' => ['required', 'string', 'max:255'],
            'vendor_latitude' => ['required', 'string', 'max:255'],
            'vendor_longitude' => ['required', 'string', 'max:255'],
            'govt_front' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'], // Max file size is set to 2MB (2048KB)
            'govt_back' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'current_utility_bill' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        // Upload and store the images
        $govtFrontPath = $request->file('govt_front')->store('public/vendor/images');
        $govtBackPath = $request->file('govt_back')->store('public/vendor/images');
        $currentUtilityBill = $request->file('current_utility_bill')->store('public/vendor/images');

        $vendor = Vendor::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'vendor_name' => $request->input('vendor_name'),
            'govt_front' => $govtFrontPath,
            'govt_back' => $govtBackPath,
            'current_utility_bill' => $currentUtilityBill,
            'country' => $request->input('country'),
            'currency' => $request->input('currency'),
            'vendor_address' => $request->input('vendor_address'),
            'vendor_latitude' => $request->input('vendor_latitude'),
            'vendor_longitude' => $request->input('vendor_longitude'),
        ]);

        $vendor->chef()->create([
            'vendor_id' => $vendor->id,
        ]);

        $vendor->deliveryCharge()->create([
            'vendor_id' => $vendor->id,
            'charge' => 0,
        ]);

        $token = Str::random(64);

        // VendorVerify::create([
        //     'vendor_id' => $vendor->id,
        //     'token' => $token
        //     ]);
        // Mail::send('vendors.verificationEmail', ['token' => $token], function($message) use($request){
        //     $message->to($request->email);
        //     $message->subject('Email Verification Mail');
        //     });


        event(new Registered($vendor));

        Auth::guard('vendor')->login($vendor);

        return redirect(RouteServiceProvider::VENDOR);
    }

    // // Verify account
    // public function verifyAccount($token)
    // {
    //     $verifyUser = VendorVerify::where('token', $token)->first();

    //     if (is_null($verifyUser)) {
    //         return redirect()->route('vendor.login')->with('message', 'Sorry, your email cannot be identified.');
    //     }

    //     $user = $verifyUser->vendor;

    //     if (!$user->is_email_verified) {
    //         $user->is_email_verified = 1;
    //         $user->save();
    //         $message = "Your email is verified. You can now login.";
    //     } else {
    //         $message = "Your email is already verified. You can now login.";
    //     }

    //     // Check if the email is not verified, and show the option to resend verification email
    //     if (!$user->is_email_verified) {
    //         $token = Str::random(64);
    //         $verifyUser->update(['token' => $token]);

    //         // Send the verification email
    //         Mail::to($user->email)->send(new VendorVerificationEmail($token, $user));
    //         // You may also include a flash message indicating that the verification email has been resent.

    //         // Redirect back to the login page with the message
    //         return redirect()->route('vendor.login')->with('message', $message)->with('resent', true);
    //     }

    //     // Redirect to the login page with the verification message
    //     return redirect()->route('vendor.login')->with('message', $message);
    // }

}
