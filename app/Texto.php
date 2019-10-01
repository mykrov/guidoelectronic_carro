<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idtexto
 * @property string $contenido
 * @property string $seccion
 * @property string $parrafo
 * @property string $nombre
 * @property string $tipo
 */
class Texto extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'texto';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idtexto';

    /**
     * @var array
     */
    protected $fillable = ['contenido', 'seccion', 'parrafo','nombre','tipo'];

}
