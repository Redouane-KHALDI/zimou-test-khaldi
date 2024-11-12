<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => 'CODE' . $this->faker->unique()->numerify('####'),
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phones' => $this->faker->phoneNumber,
            'company_name' => $this->faker->company,
            'capital' => $this->faker->randomNumber(8),
            'address' => $this->faker->address,
            'register_commerce_number' => $this->faker->unique()->numerify('RCN##########'),
            'nif' => $this->faker->unique()->numerify('NIF###############'),
            'legal_form' => $this->faker->randomNumber(1),
            'status' => $this->faker->numberBetween(1, 3),
            'can_update_preparing_packages' => $this->faker->boolean,

        ];
    }
}
