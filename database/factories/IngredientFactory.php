<?php

namespace Database\Factories;

use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ingredient>
 */
class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quantity' => $this->faker->numberBetween(1, 300),
            'unit'     => $this->faker->randomElement(['gram', 'tea spoon', 'table spoon', 'ml']),
            'name'     => $this->faker->randomElement([
                'salt',
                'black pepper',
                'water',
                'beef',
                'minced meat',
                'rice',
                'pasta',
            ]),
        ];
    }
}
