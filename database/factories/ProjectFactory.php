<?php

namespace Database\Factories;

use App\Models\Budget;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->text(400),
            'start_date' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'end_date' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'client_id' => $this->faker->randomElement(Client::all())->id,
            'budget_id' => $this->faker->randomElement(Budget::all())->id,
        ];
    }
}
