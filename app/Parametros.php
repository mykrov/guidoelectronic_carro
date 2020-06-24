<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idparametro
 * @property float $iva
 * @property float $sin_iva
 * @property float $min_pedido
 * @property int $visitas
 */
class Parametros extends Model
{
    public $timestamps = false;
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idparametro';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['iva', 'sin_iva', 'min_pedido', 'visitas'];

}
