<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiderWithdrawRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'delivery_man_id',
        'request_amount',
        'status',
    ];

    public function vendor() {
        return $this->belongsTo(DeliveryMan::class);
    }
}
