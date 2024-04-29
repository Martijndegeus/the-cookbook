<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class RecipeController extends Controller
{
    public function pdf(Recipe $recipe, int $people): Response
    {
        $pdf = Pdf::loadView('pdf.recipe',
            [
                'recipe' => $recipe,
                'people' => $people,
            ]
        );
        $pdf->getDomPDF()->set_option("enable_php", true);

        return $pdf->stream(Str::slug($recipe->name) . '.pdf');
    }
}
