<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'serialNumber',
        'productReference',
        'saleDate',
        'installation_id',
        'type_id',
        'customer_id',
        'europeanNorm_id',
        'contract_id',
        'guarantee_id',
    ];

    public function scopeSearch($query, $val)
    {
        if ($val == "/") {
            return $query
                ->where('europeanNorm_id', '=', null)
                ->orWhere('customer_id', '=', null)
                ->orWhere('installation_id', '=', null);
        } else {
            return $query
                ->where('productReference', 'LIKE', '%' . $val . '%')
                ->orWhere('serialNumber', 'LIKE', '%' . $val . '%')
                ->orWhere('saleDate', 'LIKE', '%' . $val . '%')
                ->orWhereIn('type_id', (Type::select('id')
                    ->where('characteristics', 'LIKE', '%' . $val . '%')))
                ->orWhereIn('customer_id', (Customer::select('id')
                    ->where('name', 'LIKE', '%' . $val . '%')
                    ->orWhere('streetNumber', 'LIKE', '%' . $val . '%'))
                    ->orWhere('street', 'LIKE', '%' . $val . '%')
                    ->orWhere('postalCode', 'LIKE', '%' . $val . '%')
                    ->orWhere('city', 'LIKE', '%' . $val . '%'))
                ->orWhereIn('installation_id', (Installation::select('id')
                    ->where('date', 'LIKE', '%' . $val . '%'))
                    ->orWhereIn('user_id', User::select('id')
                        ->where('lastName', 'LIKE', '%' . $val . '%')
                        ->orWhere('firstName', 'LIKE', '%' . $val . '%')));
        }
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function contract()
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

    public function supplies()
    {
        return $this->hasMany(Supply::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function europeanNorm()
    {
        return $this->belongsTo(EuropeanNorm::class, 'europeanNorm_id');
    }
}
