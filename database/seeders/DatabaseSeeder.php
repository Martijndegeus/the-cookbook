<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Step;
use Filament\Facades\Filament;
use Filament\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Filament::auth()->getProvider()->getModel()::create([
            'name'     => 'Martijn',
            'email'    => 'martijnjgeus@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $recipes = Recipe::factory(20)
            ->has(Step::factory(7))
            ->create()
            ->each(fn($recipe) => $recipe->ingredients()->saveMany(
                Ingredient::factory()->times(random_int(1, 14))->make()
            ));

        foreach ($recipes as $recipe) {
            for ($i = 0; $i < $recipe->steps->count(); $i++) {
                $recipe->steps[$i]->update(['order' => $i + 1]);
            }
        }
    }
}
