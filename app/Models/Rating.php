<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'food_id',
        'user_id',
        'rating',
        'comment',
        'delivery_man_id',
        'order_item_id',
        'drating',
        'dcomment',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    public function delivery_man()
    {
        return $this->belongsTo(DeliveryMan::class, 'deliver_man_id');
    }

    public function order_item()
    {
        return $this->belongsTo(OrderItem::class, 'order_item_id');
    }
}
