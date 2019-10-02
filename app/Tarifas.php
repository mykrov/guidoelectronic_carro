<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $nombre
 * @property float $costo
 */
class Tarifas extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tarifas_envio';

    /**
     * @var array
     */
    protected $fillable = ['nombre', 'costo'];

}
