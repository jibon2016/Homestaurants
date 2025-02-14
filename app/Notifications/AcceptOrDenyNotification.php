<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\OrderItem;

class AcceptOrDenyNotification extends Notification
{
    use Queueable;

    private OrderItem $orderItem;

    /**
     * Create a new notification instance.
     *
     * @param OrderItem $orderItem
     */
    public function __construct(OrderItem $orderItem)
    {
        $this->orderItem = $orderItem;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Delivery Man Response')
            ->greeting('Hello ' . $notifiable->name)
            ->line('Your assigned delivery man responed your request:')
            ->line('Order ID: ' . $this->orderItem->id)
            ->line('New Status: ' . $this->orderItem->delm_response)
            ->action('View Order', url('vendor/orders'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'notifiable_id' => $notifiable->id,
            'message' => 'Your assigned rider responed.',
            'order_id' => $this->orderItem->order_id,
            'status' => $this->orderItem->delm_response,
        ];
    }
}
