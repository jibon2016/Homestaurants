<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class AdminCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Make some default categories for this marketplace

        // Main categories
        $mainCategories = [
            'Fruits and Vegetables',
            'Meat and Poultry',
            'Seafood',
            'Dairy and Eggs',
            'Bakery and Bread',
            'Pantry Staples',
            'Beverages',
            'Snacks and Sweets',
            'Frozen Foods',
            'Specialty and Gourmet',
        ];

        // Subcategories for each main category
        $subCategories = [
            'Fruits and Vegetables' => [
                'Fresh Fruits',
                'Fresh Vegetables',
                'Organic Produce',
            ],
            'Meat and Poultry' => [
                'Beef',
                'Chicken',
                'Pork',
                'Lamb',
                'Exotic Meats',
            ],
            'Seafood' => [
                'Fish',
                'Shrimp',
                'Shellfish',
                'Smoked Seafood',
            ],
            'Dairy and Eggs' => [
                'Milk',
                'Cheese',
                'Butter',
                'Yogurt',
                'Eggs',
            ],
            'Bakery and Bread' => [
                'Bread Loaves',
                'Rolls and Buns',
                'Pastries',
                'Cakes',
            ],
            'Pantry Staples' => [
                'Rice',
                'Pasta',
                'Canned Goods',
                'Oils and Vinegars',
                'Spices',
            ],
            'Beverages' => [
                'Soft Drinks',
                'Juices',
                'Coffee and Tea',
                'Energy Drinks',
                'Water',
            ],
            'Snacks and Sweets' => [
                'Chips and Pretzels',
                'Cookies and Crackers',
                'Chocolates',
                'Candy',
                'Nuts',
            ],
            'Frozen Foods' => [
                'Frozen Meals',
                'Ice Cream',
                'Frozen Fruits and Vegetables',
                'Frozen Pizza',
            ],
            'Specialty and Gourmet' => [
                'Artisanal Cheeses',
                'Fine Chocolates',
                'Imported Ingredients',
                'Delicatessen',
            ],
        ];

        // Create main categories
        foreach ($mainCategories as $mainCategory) {
            $category = Category::create([
                'name' => $mainCategory,
            ]);

            // Create subcategories for each main category
            if (isset($subCategories[$mainCategory])) {
                foreach ($subCategories[$mainCategory] as $subCategory) {
                    $category->children()->create([
                        'name' => $subCategory,
                    ]);
                }
            }
        }
    }
}
