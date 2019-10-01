<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto';
    protected $primaryKey = 'idproducto';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
}
