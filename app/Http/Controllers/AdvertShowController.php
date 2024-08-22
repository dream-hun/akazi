<?php

namespace App\Http\Controllers;

use App\Models\Advert;

class AdvertShowController extends Controller
{
    public function __invoke($slug)
    {
        // Find the advert by slug
        $advert = Advert::where('slug', $slug)->first();

        // If the advert doesn't exist, redirect to the home page
        if (! $advert) {
            return redirect()->route('landing');
        }

        // Show the advert page with the advert information
        return view('adverts.show', ['advert' => $advert]);
    }
}
