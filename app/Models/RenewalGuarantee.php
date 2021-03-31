<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RenewalGuarantee extends Model
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
        'guarantee_id',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'renewal_guarantees';

    public function guarantee()
    {
        return $this->belongsTo(Guarantee::class);
    }
}
