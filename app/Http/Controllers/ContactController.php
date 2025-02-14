<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    // Show contact form
    public function contactForm(){
        return view('contact-form');
    }

    // Sending mail
    public function sendEmail(Request $request)
    {
        // Validate the input data
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        // Send the email to the admin email address from .env
        $adminEmail = env('MAIL_FROM_ADDRESS');
        Mail::to($adminEmail)
            ->send(new ContactMail($request->all()));

        // Optionally, you can flash a success message or return a response
        return redirect()->back()->with('message', 'Your message has been sent successfully.');
    }
}
