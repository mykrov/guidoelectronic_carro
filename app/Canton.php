<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $codigo
 * @property string $provincia
 * @property string $nombre
 * @property string $estado
 * @property string $CODIGOSAP
 * @property string $codigo_sap_provincia
 */
class Canton extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'canton';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'codigo';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['provincia', 'nombre', 'estado', 'CODIGOSAP', 'codigo_sap_provincia'];

}
