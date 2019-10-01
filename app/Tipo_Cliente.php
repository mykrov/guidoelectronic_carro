<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idtipo
 * @property string $tipo
 * @property string $fecha
 * @property string $operador
 */
class Tipo_Cliente extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tipo_cliente';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idtipo';

    /**
     * @var array
     */
    protected $fillable = ['tipo', 'fecha', 'operador','precio'];

}
