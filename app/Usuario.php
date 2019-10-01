<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idusuario
 * @property string $activacion
 * @property string $nombre
 * @property string $apellido
 * @property string $correo
 * @property string $contrasenia
 * @property string $identificacion
 * @property string $numero_identificacion
 * @property string $direccion
 * @property string $referencia
 * @property string $pais
 * @property string $ciudad
 * @property string $codigo_postal
 * @property string $celular1
 * @property string $celular2
 * @property string $imagen
 * @property string $img_servicios
 * @property string $img_representante
 * @property string $img_cedula
 * @property string $empresa
 * @property string $ruc
 * @property string $idtipo
 * @property string $ingreso
 */
class Usuario extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'usuario';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idusuario';

    /**
     * @var array
     */
    protected $fillable = ['activacion', 'nombre', 'apellido', 'correo', 'contrasenia', 'identificacion', 'numero_identificacion', 'direccion', 'referencia', 'pais', 'ciudad', 'codigo_postal', 'celular1', 'celular2', 'imagen', 'img_servicios', 'img_representante', 'img_cedula', 'empresa', 'ruc', 'idtipo', 'ingreso'];

}
