<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Budget>
 */
class BudgetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mount' => $this->faker->randomFloat(2, 1000, 10000),
            'description' => $this->faker->text(400),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'client_id' => $this->faker->randomElement(Client::all())->id,
        ];
    }
}
