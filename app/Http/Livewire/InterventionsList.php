<?php

namespace App\Http\Livewire;

use App\Models\Billing;
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

    public function render()
    {
        $interventions = Intervention::query()
            ->with('device')
            ->with('users')
            ->with('billing')
            ->search($this->search)
            ->orderBy($this->sortBy)
            ->paginate($this->perPage);

        return view('livewire.interventions-list', [
            'interventions'=> $interventions,
            'billings' => Billing::all()
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
