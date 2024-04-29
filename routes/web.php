<?php

use App\Http\Controllers\LocaleController;
use App\Http\Controllers\RecipeController;
use App\Livewire\RecipeView;
use App\Livewire\SearchRecipes;
use Illuminate\Support\Facades\Route;

Route::get('/', SearchRecipes::class)
    ->name('recipe.search');
Route::get('/recipe/{id}', RecipeView::class)
    ->name('recipe.view');
Route::get('/recipe/{recipe}/download/{people}', [RecipeController::class, 'pdf'])
    ->name('recipe.pdf');

Route::post('/change-locale', [LocaleController::class, 'switch'])
    ->name('locale.switch');
