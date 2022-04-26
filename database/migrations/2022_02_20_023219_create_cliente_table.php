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
        Schema::create('cliente', function (Blueprint $table) {
            $table->id('id_cliente');
            $table->string('nombres_cliente', 40);
            $table->string('apellidos_cliente', 40);
            $table->string('correo_electronico_cliente', 50)->unique();
            $table->string('celular_cliente', 10)->unique();
            $table->string('direccion_cliente', 70)->nullable();
            $table->boolean('estado_cliente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cliente');
    }
};
