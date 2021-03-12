<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guarantee extends Model
{
    use HasFactory;

    public function renewalGuarantees()
    {
        return $this->hasMany(RenewalGuarantee::class);
    }

    public function devices()
    {
        return $this->hasMany(Device::class);
    }
}
