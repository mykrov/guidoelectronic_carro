<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idcompras
 * @property int $cantidad
 * @property float $precio
 * @property float $subtotal
 * @property float $iva
 * @property float $costo_envio
 * @property float $envio_gratuito
 * @property int $iddetalle_venta
 * @property string $idproducto
 * @property float $valor_neto
 * @property string $graba_iva
 * @property string $idusua
 * @property string $estado
 * @property int $idventa
 */
class Compras extends Model
{
    public $timestamps = false;
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idcompras';

    /**
     * @var array
     */
    protected $fillable = ['cantidad', 'precio', 'subtotal', 'iva', 'costo_envio', 'envio_gratuito', 'iddetalle_venta', 'idproducto', 'valor_neto', 'graba_iva', 'idusua', 'estado', 'idventa'];

}
