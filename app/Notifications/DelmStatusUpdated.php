<?php

namespace App\Notifications;

use App\Models\DeliveryMan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DelmStatusUpdated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $delm;

    public function __construct(DeliveryMan $delm)
    {
        return $this->delm = $delm;
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
                    // ->line('The introduction to the notification.')
                    // ->action('Notification Action', url('/'))
                    // ->line('Thank you for using our application!');
                    ->subject('Vendor Status Updated')
                    ->greeting('Hello ' . $notifiable->name)
                    ->line('Your approval status has been updated by the admin.')
                    ->line('New Status: ' . $this->delm->approval_status)
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
            'notifiable_id' => $this->delm->id,
            'message' => 'Your approval status has been updated.',
            'status' => $this->delm->approval_status,
        ];
    }
}
