<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $idcategoria
 * @property string $nombre
 * @property string $estado
 */
class Categorias extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'categoria';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idcategoria';

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
    protected $fillable = ['nombre', 'estado'];

}
