<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryManVerify extends Model
{
    use HasFactory;

    public $table = 'delivery_man_verifies';

    protected $fillable = [
        'delivery_man_id',
        'token',
    ];

    public function delivery_man()
    {
        return $this->belongsTo(DeliveryMan::class);
    }
}
