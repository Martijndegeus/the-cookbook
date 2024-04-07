<?php

namespace Database\Factories;

use App\Models\Step;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Step>
 */
class StepFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'duration' => $this->faker->numberBetween(1, 30),
            'unit'     => $this->faker->randomElement(['second', 'minute', 'hour', null]),
            'order'    => $this->faker->numberBetween(0, 30),
            'action'   => $this->faker->text(),
        ];
    }
}
