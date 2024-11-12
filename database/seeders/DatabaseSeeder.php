<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\Store;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
                WilayaSeeder::class,
                CommuneSeeder::class,
                PackageStatusSeeder::class,
                DeliveryTypeSeeder::class,
            ]);

        $totalStores = 5000;
        $packagesPerStore = 100;

        Store::factory($totalStores)
            ->has(Package::factory()->count($packagesPerStore))
            ->create();
    }
}
