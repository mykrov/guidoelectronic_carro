<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $endpoint
 * @property string $login
 * @property string $secretKey
 * @property string $ambiente
 */
class DatosPTP extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'datos_p2p';

    /**
     * @var array
     */
    protected $fillable = ['endpoint', 'login', 'secretKey', 'ambiente'];

}
