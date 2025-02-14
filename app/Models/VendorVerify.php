<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorVerify extends Model
{
    use HasFactory;

    public $table = "vendor_verifies";

    /**
     * Write code on Method
     *
     * @return response()
     */
    protected $fillable = [
        'vendor_id',
        'token',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
