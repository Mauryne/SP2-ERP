<?php

namespace App\Http\Livewire;

use App\Models\Device;
use App\Models\Type;
use Livewire\Component;
use Livewire\WithPagination;

class DevicesList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $sortBy = 'serialNumber';

    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';


    public function render()
    {
        $devices = Device::query()
            ->with('type')
            ->with('europeanNorm')
            ->with('customer')
            ->search($this->search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.devices-list',[
            'devices'=> $devices
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
