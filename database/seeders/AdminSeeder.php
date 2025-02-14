<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default admins database seeder
        $admins = [
            [
                'name' => 'Pranta Mazumder',
                'email' => 'codewithpranta@gmail.com',
                'phone' => '8801518480999',
                'password' => Hash::make('12345678'),
            ],

            [
                'name' => 'Admin',
                'email' => 'admin@homestaurants.com',
                'phone' => '33751188944',
                'password' => Hash::make('Homestaurants@12345'),
            ],
        ];

        foreach ($admins as $admin) {
            Admin::create($admin);
        }
    }
}
