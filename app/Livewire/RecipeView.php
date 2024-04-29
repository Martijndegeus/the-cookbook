<?php

namespace App\Livewire;

use App\Models\Recipe;
use Livewire\Component;

class RecipeView extends Component
{
    public $recipe;
    public int $noOfPeople = 4;

    public function increaseNoOfPeople()
    {
        $this->noOfPeople++;
    }

    public function decreaseNoOfPeople()
    {
        $this->noOfPeople--;
    }

    public function mount($id)
    {
        $recipe = Recipe::findOrFail($id);
        $this->recipe = $recipe;
    }

    public function render()
    {
        return view('livewire.recipe-view');
    }
}
