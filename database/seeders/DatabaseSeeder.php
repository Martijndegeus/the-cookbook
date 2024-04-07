<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Recipe;
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

        Recipe::factory(20)
            ->has(Ingredient::factory(5))
            ->create();
    }
}
