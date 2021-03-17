<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'streetNumber',
        'street',
        'postalCode',
        'city',
        'telephoneNumber',
        'email',
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
