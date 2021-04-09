<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterventionUser extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'maintenance_id',
        'user_id',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'maintenance_user';

    public function maintenance()
    {
        return $this->belongsTo(Intervention::class, 'maintenance_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
}
