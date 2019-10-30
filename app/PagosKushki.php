<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idpago
 * @property string $fecha
 * @property string $cc_token
 * @property string $usuario
 * @property float $monto
 * @property string $estado
 * @property int $id_enta
 */
class PagosKushki extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pagos_kushki';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idpago';

    /**
     * @var array
     */
    protected $fillable = ['fecha', 'cc_token', 'usuario', 'monto', 'estado', 'id_enta'];

}
