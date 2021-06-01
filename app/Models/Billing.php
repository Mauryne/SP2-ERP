<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount',
        'type',
        'maintenance_id',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'billing';

    public function maintenance()
    {
        return $this->belongsTo(Intervention::class, 'maintenance_id');
    }
}
