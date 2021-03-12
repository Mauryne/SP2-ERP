<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    public function scopeSearch($query, $val)
    {
        return $query
            ->where('productReference', 'LIKE', '%' . $val . '%')
            ->orWhere('serialNumber', 'LIKE', '%' . $val . '%')
            ->orWhere('saleDate', 'LIKE', '%' . $val . '%');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function contracts()
    {
        return $this->belongsTo(Contract::class);
    }

    public function guarantee()
    {
        return $this->belongsTo(Guarantee::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function installation()
    {
        return $this->belongsTo(Installation::class);
    }

    public function interventions()
    {
        return $this->hasMany(Intervention::class);
    }

    public function contractsCustomersDevices()
    {
        return $this->hasMany(ContractCustomerDevice::class);
    }

    public function europeanNorm()
    {
        return $this->belongsTo(EuropeanNorm::class, 'europeanNorm_id');
    }
}
