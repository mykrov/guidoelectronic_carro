<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $idfamilia
 * @property string $idcategoria
 * @property string $nombre_familia
 * @property string $estado
 */
class Familias extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'familia';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idfamilia';

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
    protected $fillable = ['idcategoria', 'nombre_familia', 'estado'];

}
