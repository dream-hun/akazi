<?php

namespace App\Http\Controllers;

use App\Models\Company;

class EmployerIndexController extends Controller
{
    public function __invoke()
    {
        $companies = Company::paginate(15);

        return view('employers.index', ['companies' => $companies]);
    }
}
