<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function contractsCustomersDevices()
    {
        return $this->hasMany(ContractCustomerDevice::class);
    }

    public function devices()
    {
        return $this->hasMany(Device::class);
    }
}
