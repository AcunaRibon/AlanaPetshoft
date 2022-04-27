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
        Schema::create('domiciliario', function (Blueprint $table) {
            $table->string('documento_domiciliario', 10)->primary();
            $table->string('nombres_domiciliario', 30);
            $table->string('apellidos_domiciliario', 30);
            $table->string('celular_domiciliario', 10)->unique();
            $table->boolean('estado_domiciliario')->default(1);
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
        Schema::dropIfExists('domiciliario');
    }
};
