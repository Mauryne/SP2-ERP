<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractCustomerDevice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'device_id',
        'customer_id',
        'contract_id',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contract_customer_device';

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
