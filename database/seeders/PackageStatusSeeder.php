<?php

namespace Database\Seeders;

use App\Models\PackageStatus;
use Illuminate\Database\Seeder;

class PackageStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['name' => 'En attente'],
            ['name' => 'En cours de livraison'],
            ['name' => 'Livré'],
            ['name' => 'Retourné'],
            ['name' => 'Annulé'],
            ['name' => 'En transit'],
            ['name' => 'En préparation'],
            ['name' => 'Problème de livraison'],
            ['name' => 'En attente de retour'],
            ['name' => 'Prêt à être expédié'],
        ];

        foreach ($statuses as $status) {
            PackageStatus::create($status);
        }
    }
}
