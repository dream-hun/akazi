<?php

namespace App\Http\Controllers;

use App\Models\Company;

class ShowEmployerController extends Controller
{
    public function __invoke($slug)
    {
        // Find the company by slug
        $company = Company::where('slug', $slug)->firstOrFail();

        // If the company doesn't exist, redirect to the home page
        if (! $company) {
            return redirect()->route('landing');
        }
        // Show the company page with the company information
        $query = $company->adverts();
        $adverts = $query->paginate(15);

        return view('employers.show', ['company' => $company, 'adverts' => $adverts]);

    }
}
