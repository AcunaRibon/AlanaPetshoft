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
        Schema::create('producto', function (Blueprint $table) {
            $table->id('id_producto');
            $table->string('nombre_producto', 40);
            $table->integer('existencia_producto')->unsigned()->default(0);
            $table->double('precio_producto', 10, 2, true);
            $table->boolean('estado_producto');
            $table->tinyInteger('tipo_producto_id')->unsigned();
            $table->foreign('tipo_producto_id')->references('id_tipo_producto')->on('tipo_producto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto');
    }
};
