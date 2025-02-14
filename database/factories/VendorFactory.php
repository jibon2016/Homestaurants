<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vendor>
 */
class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // You can change this to generate random passwords
            'avatar' => $this->faker->imageUrl(200, 200, 'avatar'),
            'cover_photo' => $this->faker->imageUrl(800, 400, 'nature'),
            'vendor_name' => $this->faker->company,
            'govt_front' => 'public/vendor/images/default.png',
            'govt_back' => 'public/vendor/images/default.png',
            'country' => $this->faker->country,
            'currency' => $this->faker->currencyCode,
            'vendor_address' => 'Sher-E-Bangla Rd, Khulna 9208, Bangladesh',
            'vendor_latitude' => 22.8022039,
            'vendor_longitude' => 89.5339231,
            'approval_status' => 'approved',
            'remember_token' => $this->faker->randomNumber(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
