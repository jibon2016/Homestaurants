<?php

namespace App\Http\Controllers\DeliveryMan\Auth;

use App\Http\Controllers\Controller;
use App\Models\DeliveryMan;
use App\Models\DeliveryManVerify;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationEmail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('delm.auth.register');
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.DeliveryMan::class],
            'phone' => ['required', 'string', 'min:9', 'max:14', 'unique:delivery_men'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'delm_address' => ['required', 'string', 'max:255'],
            'delm_latitude' => ['required', 'string', 'max:255'],
            'delm_longitude' => ['required', 'string', 'max:255'],
            'govt_front' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'], // Max file size is set to 2MB (2048KB)
            'govt_back' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'car_type' => ['required'],
            'driving_license' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'], // Max file size is set to 2MB (2048KB)
            'car_license' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        // Upload and store the images
        $govtFrontPath = $request->file('govt_front')->store('public/delm/images');
        $govtBackPath = $request->file('govt_back')->store('public/delm/images');

        // Upload and store the optional images

        if ($request->hasFile('driving_license')) {
            $drivingLicensePath = $request->file('driving_license')->store('delm/images');
        } else {
            // Handle the case when the driving license file is not present
            $drivingLicensePath = null; // Or provide a default value if needed
        }

        if ($request->hasFile('car_license')) {
            $carLicensePath = $request->file('car_license')->store('delm/images');
        } else {
            // Handle the case when the car license file is not present
            $carLicensePath = null; // Or provide a default value if needed
        }

        $delivery_man = DeliveryMan::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'govt_front' => $govtFrontPath,
            'govt_back' => $govtBackPath,
            'car_type' => $request->input('car_type'),
            'driving_license' => $drivingLicensePath,
            'car_license' => $carLicensePath,
            'delm_address' => $request->input('delm_address'),
            'delm_latitude' => $request->input('delm_latitude'),
            'delm_longitude' => $request->input('delm_longitude'),
        ]);

        // $token = Str::random(64);

        // DeliveryManVerify::create([
        //     'delivery_man_id' => $delivery_man->id,
        //     'token' => $token
        //     ]);
        // Mail::send('delm.verificationEmail', ['token' => $token], function($message) use($request){
        //     $message->to($request->email);
        //     $message->subject('Verify your email');
        //     });


        event(new Registered($delivery_man));

        Auth::guard('delivery_man')->login($delivery_man);

        return redirect(RouteServiceProvider::DELIVERYMAN);
    }


    public function verifyAccount($token)
    {
        $verifyUser = DeliveryManVerify::where('token', $token)->first();

        if (is_null($verifyUser)) {
            return redirect()->route('delm.login')->with('message', 'Sorry, your email cannot be identified.');
        }

        $user = $verifyUser->delivery_man;

        if (!$user->is_email_verified) {
            $user->is_email_verified = 1;
            $user->save();
            $message = "Your email is verified. You can now login.";
        } else {
            $message = "Your email is already verified. You can now login.";
        }

        // Check if the email is not verified, and show the option to resend verification email
        if (!$user->is_email_verified) {
            $token = Str::random(64);
            $verifyUser->update(['token' => $token]);

            // Send the verification email
            Mail::to($user->email)->send(new VerificationEmail($token, $user));
            // You may also include a flash message indicating that the verification email has been resent.

            // Redirect back to the login page with the message
            return redirect()->route('delm.login')->with('message', $message)->with('resent', true);
        }

        // Redirect to the login page with the verification message
        return redirect()->route('delm.login')->with('message', $message);
    }
}
