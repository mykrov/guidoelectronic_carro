<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idimagen
 * @property string $directorio
 * @property string $nombre
 * @property string $estado
 * @property SeccionImagen[] $seccionImagens
 */
class Imagen extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'imagen';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idimagen';

    /**
     * @var array
     */
    protected $fillable = ['directorio', 'nombre', 'estado'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seccionImagens()
    {
        return $this->hasMany('App\SeccionImagen', 'id_imagen', 'idimagen');
    }
}
