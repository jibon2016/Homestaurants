<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Order extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_phone',
        'delivery_address',
        'delivery_option',
        'expected_receive_time',
        'total_price',
        'payment_method',
        'payment_status',
        'payment_intent_id',
        'paymentID',
        'trxID',
    ];

    // Make relationship with order_items pivot table
    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }

    public function user() {
        return $this->belongsTo(Order::class);
    }

}
