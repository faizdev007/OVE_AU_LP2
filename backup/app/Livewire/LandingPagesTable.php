<?php

namespace App\Livewire;

use App\Models\LandingPage;
use Livewire\Component;
use Livewire\WithPagination;

class LandingPagesTable extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $updatesQueryString = ['search', 'sortField', 'sortDirection'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $landing_pages = LandingPage::query()
            ->where('page_name', 'like', '%'.$this->search.'%')
            ->orWhere('lp_theme', 'like', '%'.$this->search.'%')
            ->orWhere('lp_url', 'like', '%'.$this->search.'%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.landing-pages-table', compact('landing_pages'));
    }
}
