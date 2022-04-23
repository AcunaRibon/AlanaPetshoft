<?php

use Brick\Math\BigInteger;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta', function (Blueprint $table) {
            $table->id('id_venta');
            $table->date('fecha_venta');
            $table->double('descuento_venta', 9, 2, true);
            $table->double('total_venta', 10, 2, true);
            $table->tinyInteger('calificacion_servicio_venta', false, true)->nullable();
            $table->bigInteger('cliente_id')->unsigned();
            $table->string('domiciliario_documento', 10);
            $table->tinyInteger('estado_venta_id')->unsigned();
            $table->foreign('cliente_id')->references('id_cliente')->on('cliente');
            $table->foreign('domiciliario_documento')->references('documento_domiciliario')->on('domiciliario');
            $table->foreign('estado_venta_id')->references('id_estado_venta')->on('estado_venta');
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
};
