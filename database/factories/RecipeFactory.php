<?php

namespace Database\Factories;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'             => $this->faker->words(2, true),
            'description'      => $this->faker->text(),
            'number_of_people' => $this->faker->randomElement([1, 2, 3, 4, 5, 6]),
        ];
    }
}
