<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaDetalleVentas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_venta');
            $table->unsignedBigInteger('id_producto');
            $table->decimal('precio',8,2);
            $table->integer('cantidad');
            $table->decimal('subtotal',8,2);
            $table->decimal('iva',8,2);
            $table->decimal('neto',8,2);
            $table->string('estado',1)->default('A');
            $table->string('graba_iva',1);
            $table->decimal('costo_envio',8,2);
            $table->decimal('envio_gratuito',8,2);

            $table->foreign('id_venta','fk_venta_detalleventa')->references('id')->on('venta');
            $table->foreign('id_producto','fk_producto_detalleventa')->references('id')->on('productos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_ventas');
    }
}
