<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class FoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) { // Adjust the loop count as per your requirement
            $food = [
                'vendor_id' => /* $faker->numberBetween(1, 20) */ 18,
                'category_id' => $faker->numberBetween(1, 40),
                'food_name' => $faker->word,
                'featured_image' => $faker->imageUrl(),
                'first_image' => $faker->imageUrl(),
                'second_image' => $faker->imageUrl(),
                'third_image' => $faker->imageUrl(),
                'fourth_image' => $faker->imageUrl(),
                'description' => $faker->paragraph,
                'price' => $faker->randomFloat(2, 1, 1000),
                'discount' => $faker->randomFloat(2, 0, 100),
                'final_price' => $faker->randomFloat(2, 1, 1000),
                'currency' => $faker->currencyCode,
                'unit_amount' => $faker->randomNumber(2),
                'unit_name' => $faker->word,
                'available_quantity' => $faker->numberBetween(0, 100),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ];

            DB::table('foods')->insert($food);
        }
    }
}
