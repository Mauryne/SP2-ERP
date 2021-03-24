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

    public function scopeSearch($query, $val)
    {
        return $query
            ->where('name', 'LIKE', '%' . $val . '%')
            ->orWhere('streetNumber', 'LIKE', '%' . $val . '%')
            ->orWhere('street', 'LIKE', '%' . $val . '%')
            ->orWhere('postalCode', 'LIKE', '%' . $val . '%')
            ->orWhere('city', 'LIKE', '%' . $val . '%')
            ->orWhere('telephoneNumber', 'LIKE', '%' . $val . '%')
            ->orWhere('email', 'LIKE', '%' . $val . '%');

    }

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

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
