<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $idmarca
 * @property string $nombre_marca
 * @property string $estado
 */
class Marca extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'marca';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idmarca';

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
    protected $fillable = ['nombre_marca', 'estado'];

}
