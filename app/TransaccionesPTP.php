<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $requestId
 * @property string $reference
 * @property string $signature
 * @property string $date
 * @property string $status
 * @property string $reason
 * @property string $processUrl
 * @property float $monto
 */
class TransaccionesPTP extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'transacciones_p2p';

    /**
     * @var array
     */
    protected $fillable = ['requestId', 'reference', 'signature', 'date', 'status', 'reason','processUrl','monto'];

}
