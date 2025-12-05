<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    /**
     * Set the application locale
     */
    public function set(Request $request)
    {
        $locale = $request->input('locale', 'en');

        // Validate locale
        if (! in_array($locale, ['en', 'pt'])) {
            $locale = 'en';
        }

        // Store locale in session
        session(['locale' => $locale]);

        return back();
    }
}
