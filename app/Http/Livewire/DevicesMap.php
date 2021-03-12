<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Livewire\Component;

class DevicesMap extends Component
{
    public $customer;

    public function mount($id)
    {
        $this->customer = Customer::find($id);
    }

    public function render()
    {
        return view('livewire.devices-map', [
            'customer' => $this->customer,
        ]);
    }
}
