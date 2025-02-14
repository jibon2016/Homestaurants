<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vendor;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';

    protected $fillable = [
        'vendor_id',
        'category_id',
        'food_name',
        'featured_image',
        'first_image',
        'second_image',
        'third_image',
        'fourth_image',
        'description',
        'price',
        'discount',
        'final_price',
        'currency',
        'unit_amount',
        'unit_name',
        'available_quantity',
    ];

    // Vendor foods
    public function vendor() {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    // One to Many relationship with categories
    public function category() {
        return $this->belongsTo(Category::class);
    }

    // Filter by category on specific vendor page
    public function scopeFilterByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    // Food belongs to cart
    public function carts() {
        return $this->hasMany(Cart::class);
    }

    public function ratings() {
        return $this->hasMany(Rating::class);
    }
}
