<?php

namespace App\Http\Livewire;

use App\Models\Intervention;
use Livewire\Component;
use Livewire\WithPagination;

class InterventionsList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $sortBy = 'streetNumber';

    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';

    public function mount(){

    }

    public function render()
    {
        $interventions = Intervention::query()
            ->with('device')
            ->with('users')
            ->search($this->search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.interventions-list', [
            'interventions'=> $interventions
        ]);
    }

    public function sortBy($field)
    {
        if ($this->sortDirection == 'asc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }

        return $this->sortBy = $field;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
