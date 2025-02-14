<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class NewOrderNotification extends Notification
{
    use Queueable;

    private Order $order;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
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
        // Use $this->orderItem to access the properties of the OrderItem model
        return (new MailMessage)
            ->subject('New Order Placed')
            ->greeting('Hello ' . $notifiable->name)
            ->line('A new order has been placed in your account.')
            ->line('Order ID: ' . $this->order->id)
            ->line('Customer Name: ' . $this->order->customer_name)
            ->line('Customer Phone: ' . $this->order->customer_phone)
            // Add more relevant information from the OrderItem as needed
            ->line('Thank you for using our marketplace!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        // Use $this->orderItem to access the properties of the OrderItem model
        return [
            'notifiable_id' => $notifiable->id,
            'message' => 'A new order has been placed in your account.',
            'id' => $this->order->id,
            'customer_name' => $this->order->customer_name,
            'customer_phone' => $this->order->customer_phone,
            // Add more relevant information from the OrderItem as needed
        ];
    }
}
