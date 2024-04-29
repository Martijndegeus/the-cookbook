<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function switch(Request $request): RedirectResponse
    {
        $locale = $request->get('locale');

        session(['locale' => $locale]);

        return redirect()->back()->with(['new_locale' => $locale]);
    }
}
