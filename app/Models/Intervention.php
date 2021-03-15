<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'streetNumber',
        'street',
        'postalCode',
        'city',
        'date',
        'actions',
        'device_id',
        'user_id',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'maintenances';

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
