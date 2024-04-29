<?php

namespace Database\Factories;

use App\Models\Ingredient;
use Bezhanov\Faker\Provider\Food;
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
        $this->faker->addProvider(new Food($this->faker));
        return [
            'quantity' => $this->faker->numberBetween(1, 300),
            'unit'     => $this->faker->randomElement(['gram', 'tea spoon', 'table spoon', 'ml']),
            'name'     => $this->faker->randomElement([$this->faker->ingredient, $this->faker->spice]),
        ];
    }
}
