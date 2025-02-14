<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'vendor_id',
        'food_id',
        'quantity',
        'price',
        'delivery_men_id',
        'delivery_charge',
        'earn_price',
        'order_status',
        'currency',
        'payment_method',
        'delivery_option',
        'request_message',
        'delm_response',
    ];

    // Define relationship with orders, vendors, and foods table

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    public function rating()
    {
        return $this->hasOne(Rating::class);
    }

    public function delivery_man()
    {
        return $this->belongsTo(DeliveryMan::class, 'delivery_men_id');
    }

}
