<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferBadge extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'badge_line',
        'start_date',
        'end_date',
    ];

    public function vendor() {
       return $this->belongsTo(Vendor::class);
    }
}
