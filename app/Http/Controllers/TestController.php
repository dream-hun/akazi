<?php

namespace App\Http\Controllers;

use App\Models\Advert;

class TestController extends Controller
{
    public function __invoke()
    {
        $adverts = Advert::with(['category', 'company']);

        return view('test', ['adverts' => $adverts->paginate(10)]);
    }
}
