<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guarantee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'initialDuration',
        'device_id',
    ];

    public function renewalGuarantees()
    {
        return $this->hasMany(RenewalGuarantee::class);
    }

    public function devices()
    {
        return $this->hasMany(Device::class);
    }
}
