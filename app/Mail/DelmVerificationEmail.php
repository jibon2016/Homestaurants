<?php

namespace App\Mail;

use App\Models\DeliveryMan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DelmVerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($token, DeliveryMan $user)
    {
        $this->token = $token;
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('emails.delm-verification')
            ->subject('Verify your email address');
    }
}
