<?php

namespace App\Livewire;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class SearchRecipes extends Component
{
    use WithPagination;

    #[Url(except: '')]
    public string $searchQuery = '';
    public string $orderBy = '';
    public string $orderDirection = 'asc';

    public function orderResult(string $orderBy): void
    {
        $newSubject = false;

        if ($orderBy !== $this->orderBy) {
            $newSubject = true;
        }

        $this->orderBy = $orderBy;

        if (!$newSubject) {
            $this->toggleOrderDirection();
        }
    }

    public function toggleOrderDirection(): void
    {
        if ($this->orderDirection == 'asc') {
            $this->orderDirection = 'desc';
        } else {
            $this->orderDirection = 'asc';
        }
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $recipeQueryBuilder = Recipe::where('name', 'LIKE', '%' . $this->searchQuery . '%')
            ->orWhereHas('ingredients', function ($query) {
                $query->where('name', 'LIKE', '%' . $this->searchQuery . '%');
            });

        if ($this->orderBy == 'time') {
            $recipeQueryBuilder->withSum('steps', 'duration')->orderBy('steps_sum_duration', $this->orderDirection);
        } elseif ($this->orderBy == 'ingredients') {
            $recipeQueryBuilder->withCount('ingredients')->orderBy('ingredients_count', $this->orderDirection);
        }

        $ingredients = Ingredient::select('name', DB::raw('count(name) as count'))
            ->groupBy('name')
            ->orderByDesc(DB::raw('count(name)'))
            ->take(45)
            ->get();

        return view('livewire.search-recipes',
            [
                'recipes'     => $recipeQueryBuilder->paginate(10),
                'ingredients' => $ingredients,
            ]);
    }
}
