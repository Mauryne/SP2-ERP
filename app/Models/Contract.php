<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'initialDuration',
        'customer_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function renewalContracts()
    {
        return $this->hasMany(RenewalContract::class);
    }

    public function devices()
    {
        return $this->hasMany(Device::class);
    }

    public function contractsCustomersDevices()
    {
        return $this->hasMany(ContractCustomerDevice::class);
    }
}
