<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create plans seeder array
        $plans = [

            [
                'name' => 'Free',
                'slug' => 'free',
                'stripe_plan' => 'price_1ND7PDGxvUIKiOqhXWnnDaVW',
                'price' => 0,
                'description' => 'Lifetime free access to sell foods on Homestaurant\'s.',
            ],

            [
                'name' => 'Business',
                'slug' => 'business',
                'stripe_plan' => 'price_1NCRbCGxvUIKiOqhZiTB6Nks',
                'price' => 29,
                'description' => 'Business plan gives you some extra features and increase your orders.',
            ],

            [
                'name' => 'Premium',
                'slug' => 'premium',
                'stripe_plan' => 'price_1NCRd0GxvUIKiOqhIXO4bAGa',
                'price' => 49,
                'description' => 'Premium plan lists you as a featured Homestaurant\'s owner which will boost your selling rate
                dramatically.',
            ],

            ];

            foreach($plans as $plan){
                Plan::create($plan);
            }
    }
}
