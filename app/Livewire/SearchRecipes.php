<?php

namespace App\Livewire;

use App\Models\Recipe;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class SearchRecipes extends Component
{
    public ?string $searchQuery = null;

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.search-recipes',
            ['recipes' => Recipe::where('name', 'LIKE', '%' . $this->searchQuery . '%')->get()]);
    }
}
