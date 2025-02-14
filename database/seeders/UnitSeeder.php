<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unitNames = [
            "kg",
            "gm",
            "ml",
            "pc",
            "ltr",
            "plt",
            "cm",
            "inch",
            "lb",
            "cup",
        ];

        foreach ($unitNames as $unitName) {
            Unit::create(['unit_name' => $unitName]);
        }
    }
}
