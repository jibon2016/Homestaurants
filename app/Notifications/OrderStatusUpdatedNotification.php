<?php

namespace App\Notifications;

use App\Models\OrderItem;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderStatusUpdatedNotification extends Notification //implements ShouldQueue
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
            ->subject('Order Status Updated')
            ->greeting('Hello ' . $notifiable->name)
            ->line('The order status has been updated:')
            ->line('Order ID: ' . $this->orderItem->id)
            ->line('New Status: ' . $this->orderItem->order_status)
            ->action('View Order', url('customer-orders'));
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
            'message' => 'The order status has been updated.',
            'order_id' => $this->orderItem->order_id,
            'status' => $this->orderItem->order_status,
        ];
    }
}
