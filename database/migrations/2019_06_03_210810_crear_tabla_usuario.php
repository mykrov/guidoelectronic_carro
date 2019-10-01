<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('nombre',50);
            $table->string('apellido',50);
            $table->string('correo',100);
            $table->string('contrasenia',200);
            $table->string('identificacion',3);
            $table->string('numero_identificacion',50);
            $table->string('direccion',100);
            $table->string('referencia',50)->nullable();
            $table->string('pais',50);
            $table->string('ciudad',50);
            $table->string('celular1',20)->nullable();
            $table->string('celular2',20)->nullable();
            $table->string('imagen',50)->nullable();
            $table->string('imagen_cedula',50)->nullable();
            $table->string('imagen_servicio',50)->nullable();
            $table->string('imagen_representante',50)->nullable();
            $table->string('empresa',50);
            $table->string('ruc',50)->unique();
            $table->string('id_tipo',50);
            $table->string('ingreso',50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario');
    }
}
