<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idventas
 * @property int $iddetalle_ventas
 * @property float $subtotal
 * @property float $iva
 * @property float $costo_envio
 * @property int $envio_gratuito
 * @property float $total
 * @property string $fecha
 * @property string $estado
 * @property string $Graba_Iva
 * @property string $token
 * @property string $idusuario
 * @property string $ruc
 * @property string $tipoPago
 * @property string $estadoPago
 */
class Ventas extends Model
{
    public $timestamps = false;
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idventas';

    /**
     * @var array
     */
    protected $fillable = ['iddetalle_ventas', 'subtotal', 'iva', 'costo_envio', 'envio_gratuito', 'total', 'fecha', 'estado', 'Graba_Iva', 'token', 'idusuario','ruc','tipoPago','estadoPago'];

}
