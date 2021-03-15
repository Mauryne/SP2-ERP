<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'streetNumber',
        'street',
        'postalCode',
        'city',
        'telephoneNumber',
        'email',
    ];

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
