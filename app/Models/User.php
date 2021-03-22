<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lastName',
        'firstName',
        'email',
        'email_verified_at',
        'password',
        'telephoneNumber',
        'role_id',
        'remember_token',
    ];

    public function scopeSearch($query, $val)
    {
        return $query
            ->where('firstName', 'LIKE', '%' . $val . '%')
            ->orWhere('lastName', 'LIKE', '%' . $val . '%')
            ->orWhere('email', 'LIKE', '%' . $val . '%')
            ->orWhere('telephoneNumber', 'LIKE', '%' . $val . '%')
            ->orWhereIn('role_id', (Role::select('id')
                ->where('name', 'LIKE', '%' . $val . '%')));
    }

    public
    function installations()
    {
        return $this->hasMany(Installation::class);
    }

    public
    function role()
    {
        return $this->belongsTo(Role::class);
    }

    public
    function interventions()
    {
        return $this->belongsToMany(Intervention::class, 'maintenance_user');
    }

}
