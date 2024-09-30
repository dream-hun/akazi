<?php

namespace App\View\Components;

use App\Models\Advert;
use App\Models\Category;
use App\Models\Company;
use App\Models\Contact;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardStatComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $categories = Category::count();
        $adverts = Advert::count();
        $companies = Company::count();
        $contacts = Contact::count();
        return view('components.dashboard-stat-component', ['categories' => $categories, 'adverts' => $adverts, 'companies' => $companies, 'contacts' => $contacts]);
    }
}
