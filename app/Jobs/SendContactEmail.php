<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class SendContactEmail implements ShouldQueue
{
    /**
     * Note that it's not using at this moment it will be used in future to reduce time
     * Or upgrade user experience when send mail message
     */
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $formData;

    public function __construct(array $formData)
    {
        $this->formData = $formData;
    }

    public function handle()
    {
        Mail::to(config('mail.admin_email'))
            ->send(new ContactMail($this->formData));
    }
}
