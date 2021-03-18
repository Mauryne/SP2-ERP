<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'picture_path',
        'summary',
        'user_id',
    ];

    public function devices()
    {
        return $this->hasMany(Device::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function guarantee()
    {
        return $this->belongsTo(Guarantee::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
