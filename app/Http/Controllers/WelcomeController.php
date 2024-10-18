<?php

namespace App\Http\Controllers;

use App\Models\Advert;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $adverts = Advert::latest()->take(60)->get();

        return view('welcome', ['adverts' => $adverts]);
    }
}
