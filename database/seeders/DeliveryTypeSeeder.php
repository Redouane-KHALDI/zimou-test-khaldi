<?php

namespace Database\Seeders;

use App\Models\DeliveryType;
use Illuminate\Database\Seeder;

class DeliveryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Air'],
            ['name' => 'Route'],
            ['name' => 'Mer'],
            ['name' => 'Ferroviaire'],
        ];

        foreach ($types as $type) {
            DeliveryType::create($type);
        }
    }
}
