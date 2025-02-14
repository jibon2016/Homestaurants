<?php

namespace App\Notifications;

use App\Models\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VendorStatusUpdated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $vendor;

    public function __construct(Vendor $vendor)
    {
        // Call vendor instance
        $this->vendor = $vendor;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Vendor Status Updated')
            ->greeting('Hello ' . $notifiable->name)
            ->line('Your vendor status has been updated by the admin.')
            ->line('New Status: ' . $this->vendor->approval_status)
            ->line('Thank you for being a part of our marketplace!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'notifiable_id' => $this->vendor->id,
            'message' => 'Your vendor status has been updated.',
            'status' => $this->vendor->approval_status,
        ];
    }
}
