<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function devices()
    {
        return $this->hasMany(Device::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
