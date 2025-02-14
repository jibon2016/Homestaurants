<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorSchedule extends Model
{
    use HasFactory;

    protected $table = 'vendor_schedules';
    protected $fillable = ['day', 'off_day', 'opening_time', 'closing_time'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
