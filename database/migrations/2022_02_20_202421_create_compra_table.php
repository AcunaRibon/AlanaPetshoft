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
        Schema::create('compra', function (Blueprint $table) {
            $table->id('id_compra');
            $table->double('total_compra', 10, 2, true);
            $table->date('fecha_pedido_compra');
            $table->date('fecha_entrega_compra');
            $table->string('estado_pedido_compra', 20);
            $table->smallInteger('proveedor_id')->unsigned();
            $table->foreign('proveedor_id')->references('id_proveedor')->on('proveedor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compra');
    }
};
