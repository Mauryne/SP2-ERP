<?php

namespace App\Http\Livewire;

use App\Models\Intervention;
use Livewire\Component;

class InterventionMap extends Component
{
    public $intervention;

    public function mount($id)
    {
        $this->intervention = Intervention::find($id);
    }

    public function render()
    {
        return view('livewire.interventions-map', [
            'intervention' => $this->intervention,
        ]);
    }
}
