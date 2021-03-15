<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EuropeanNorm extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'picture',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'european_norms';

    public function devices()
    {
        return $this->hasMany(Device::class);
    }
}
