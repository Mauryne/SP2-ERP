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

    public function scopeSearch($query, $val)
    {
        return $query
            ->where('streetNumber', 'LIKE', '%' . $val . '%')
            ->orWhere('street', 'LIKE', '%' . $val . '%')
            ->orWhere('postalCode', 'LIKE', '%' . $val . '%')
            ->orWhere('city', 'LIKE', '%' . $val . '%')
            ->orWhere('date', 'LIKE', '%' . $val . '%')
            ->orWhere('actions', 'LIKE', '%' . $val . '%');
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
