<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['parent_id', 'name'];

    // Create relationship between subcategory and category
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Many to Many relationship with categories
    public function foods() {
        return $this->hasMany(Food::class);
    }
}
