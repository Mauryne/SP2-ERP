<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RenewalContract extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'duration',
        'signatureDate',
        'contract_id',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'renewal_contracts';

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
