<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_imagen
 * @property string $nombre_seccion
 * @property string $estado
 * @property Imagen $imagen
 */
class Seccion_imagen extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'seccion_imagen';

    /**
     * @var array
     */
    protected $fillable = ['id_imagen', 'nombre_seccion', 'estado'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function imagen()
    {
        return $this->belongsTo('App\Imagen', 'id_imagen', 'idimagen');
    }
}
