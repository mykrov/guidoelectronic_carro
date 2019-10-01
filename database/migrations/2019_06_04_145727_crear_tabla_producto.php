<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaProducto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('descripcion',50);
            $table->string('imagen',50);
            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_familia');
            $table->unsignedBigInteger('id_marca');
            $table->string('recomendado',1)->default('N');
            $table->string('idcolor',20);
            $table->string('graba_iva',50);
            $table->bigInteger('stock');
            $table->string('estado',1);
            $table->decimal('precio',8,2);
            $table->decimal('precio2',8,2)->nullable();
            $table->decimal('precio3',8,2)->nullable();
            $table->decimal('precio4',8,2)->nullable();
            $table->decimal('precio5',8,2)->nullable();
            $table->decimal('precio_anterior',8,2)->nullable();
            $table->decimal('total_con_iva',8,2)->nullable();
            $table->decimal('total_con_iva2',8,2)->nullable();
            $table->decimal('oferta_con_iva',8,2)->nullable();
            $table->decimal('oferta_con_iva2',8,2)->nullable();
            $table->decimal('costo_envio',8,2)->nullable();
            $table->decimal('oferta',8,2)->nullable();
            $table->decimal('iva',8,2);
            $table->decimal('porcentaje_oferta',8,2)->nullable();
            $table->decimal('envio_gratuito',8,2);

            $table->foreign('id_categoria','fk_categoria_producto')->references('id')->on('categorias');
            $table->foreign('id_familia','fk_familia_producto')->references('id')->on('familas');
            $table->foreign('id_marca','fk_marca_producto')->references('id')->on('marcas');

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
        Schema::dropIfExists('productos');
    }
}
