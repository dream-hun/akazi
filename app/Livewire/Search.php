<?php

namespace App\Livewire;

use App\Models\Advert;
use Livewire\Component;

class Search extends Component
{
    public $search = '';
    public $results = [];
    public $selectedIndex = -1;
    public $showResults = false;

    public function updatedSearch()
    {
        $this->selectedIndex = -1;
        $this->showResults = strlen($this->search) > 2;
        
        if ($this->showResults) {
            $this->results = Advert::query()
                ->select(['id', 'title', 'slug', 'body', 'company_id'])
                ->with(['company:id,name'])
                ->where(function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%')
                          ->orWhere('body', 'like', '%' . $this->search . '%');
                })
                ->latest()
                ->limit(5)
                ->get();
        } else {
            $this->results = [];
        }
    }

    public function incrementIndex()
    {
        if ($this->selectedIndex < count($this->results) - 1) {
            $this->selectedIndex++;
        }
    }

    public function decrementIndex()
    {
        if ($this->selectedIndex > -1) {
            $this->selectedIndex--;
        }
    }

    public function selectResult()
    {
        if ($this->selectedIndex > -1 && isset($this->results[$this->selectedIndex])) {
            return redirect()->route('adverts.show', $this->results[$this->selectedIndex]->slug);
        }
    }

    public function hideResults()
    {
        $this->showResults = false;
    }

    public function render()
    {
        return view('livewire.search', ['results' => $this->results]);
    }
}
