<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'request_amount',
        'currency',
        'status',
    ];

    public function vendor() {
        return $this->belongsTo(Vendor::class);
    }
}
