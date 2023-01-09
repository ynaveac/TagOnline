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
        Schema::create('RequestTag', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha_proceso');
            $table->Integer('local')->default(0)->comment('id de identifcacion del local, en este caso virtual');
            $table->Integer('vendedor')->default(0)->comment('id de identifcacion del vendedor, en este caso virtual');
            $table->tinyInteger('tipo')->comment('0: Seleccione, 1: Natural, 2: Empresa');
            $table->string('rut', 11)->nullable();
            $table->string('rut_representante', 11)->nullable();
            $table->string('nombre_representante')->nullable();
            $table->string('nombre')->nullable();
            $table->string('apellidos')->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('patente')->nullable();
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('observaciones')->nullable();
            //$table->tinyInteger('natural')->default(0);
            //$table->tinyInteger('empresa')->default(0);
            $table->string('estado')->nullable();
            $table->Integer('local_retiro')->nullable();
            $table->string('cod_seguimiento')->nullable();
            $table->Integer('asociado_retiro')->nullable();
            $table->string('cod_tag')->nullable();
            
            //$table->string('rol')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('RequestTag');
    }
};
