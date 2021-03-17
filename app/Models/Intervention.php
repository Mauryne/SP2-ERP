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
        'comment',
        'externalProvider',
        'device_id',
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
            ->orWhere('comment', 'LIKE', '%' . $val . '%')
            ->orWhereIn('device_id', (Device::select('id')
                ->where('serialNumber', 'LIKE', '%' . $val . '%')
                ->orWhere('productReference', 'LIKE', '%' . $val . '%')))
//            ->orWhereIn('user_id', (User::select('id')
//                ->where('name', 'LIKE', '%' . $val . '%')));
            ->orWhereIn('id', (InterventionUser::select('maintenance_id')
                ->whereIn('user_id', User::select('id')
                    ->where('name', 'LIKE', '%' . $val . '%'))));
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'maintenance_user', 'maintenance_id');
    }
}
