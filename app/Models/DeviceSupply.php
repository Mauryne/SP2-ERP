<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceSupply extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'device_id',
        'supply_id',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'device_supply';

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function supply()
    {
        return $this->belongsTo(Supply::class);
    }
}
