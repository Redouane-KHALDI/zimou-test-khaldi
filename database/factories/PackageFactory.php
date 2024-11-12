<?php

namespace Database\Factories;

use App\Models\Commune;
use App\Models\DeliveryType;
use App\Models\PackageStatus;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid,
            'tracking_code'     => 'TRACK' . $this->faker->unique()->numerify('########'),
            'commune_id'        => Commune::inRandomOrder()->first()->id,
            'delivery_type_id'  => DeliveryType::inRandomOrder()->first()->id,
            'status_id'         => PackageStatus::inRandomOrder()->first()->id,
            'store_id'          => Store::inRandomOrder()->first()->id,
            'address'           => $this->faker->address,
            'can_be_opened'     => $this->faker->boolean,
            'name'              => $this->faker->optional()->word,
            'client_first_name' => $this->faker->firstName,
            'client_last_name'  => $this->faker->lastName,
            'client_phone'      => $this->faker->phoneNumber,
            'client_phone2'     => $this->faker->optional()->phoneNumber,
            'cod_to_pay'        => $this->faker->randomFloat(2, 1, 100),
            'commission'        => $this->faker->randomFloat(2, 1, 100),
            'status_updated_at' => $this->faker->optional()->dateTimeThisMonth(),
            'delivered_at'      => $this->faker->optional()->dateTimeThisYear(),
            'delivery_price'    => $this->faker->randomFloat(2, 1, 100),
            'extra_weight_price'=> $this->faker->randomFloat(2, 1, 100),
            'free_delivery'     => $this->faker->boolean,
            'packaging_price'   => $this->faker->randomFloat(2, 1, 30),
            'partner_cod_price' => $this->faker->randomFloat(2, 1, 50),
            'partner_delivery_price' => $this->faker->randomFloat(2, 1, 200),
            'partner_return'    => $this->faker->randomFloat(2, 1, 100),
            'price'             => $this->faker->randomFloat(2, 1, 1000),
            'price_to_pay'      => $this->faker->randomFloat(2, 1, 100),
            'return_price'      => $this->faker->randomFloat(2, 1, 30),
            'total_price'       => $this->faker->randomFloat(2, 1, 100),
            'weight'            => $this->faker->numberBetween(500, 2000),
        ];
    }
}
