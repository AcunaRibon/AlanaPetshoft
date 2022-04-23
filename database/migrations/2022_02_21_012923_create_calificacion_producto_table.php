<?php

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
        Schema::create('calificacion_producto', function (Blueprint $table) {
            $table->id('id_calificacion_producto');
            $table->tinyInteger('valor_calificacion_producto')->unsigned();
            $table->bigInteger('producto_id')->unsigned();
            $table->foreign('producto_id')->references('id_producto')->on('producto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calificacion_producto');
    }
};
