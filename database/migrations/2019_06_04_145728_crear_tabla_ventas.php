<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaVentas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_usuario');
            $table->decimal('subtotal',8,2);
            $table->decimal('total',8,2);
            $table->decimal('iva',8,2);
            $table->decimal('costo_envio',8,2);
            $table->decimal('envio_gratuito',8,2);
            $table->string('estado',1)->default('A');
            $table->string('graba_iva',1)->default('S');
            $table->string('token',100);
            $table->timestamp('fecha');
            $table->timestamps();

            $table->foreign('id_usuario','fk_usuario_venta')->references('id')->on('usuario')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venta');
    }
}
