<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'price',
        'quantity',
        'provider_id',
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function supply()
    {
        return $this->belongsTo(Supply::class);
    }
}
