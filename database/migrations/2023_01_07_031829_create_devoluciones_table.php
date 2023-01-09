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
        Schema::create('devoluciones', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('cod_tag')->nullable();
            $table->Integer('asociado_recepcion')->nullable();
            $table->string('estado')->nullable();
            $table->string('tag')->nullable();
            $table->string('rut', 11)->nullable();
            $table->string('nombre')->nullable();
            $table->string('apellidos')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('patente')->nullable();
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('carnetfrontal')->nullable();
            $table->string('rutempresa', 11)->nullable();
            $table->string('nombreempresa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devoluciones');
    }
};
