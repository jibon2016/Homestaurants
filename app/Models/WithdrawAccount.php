<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'payment_method',
        'holder_name',
        'account_no',
        'routing_number',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
