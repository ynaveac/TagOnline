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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->Integer('id_RequestTag')->default(0);
            $table->string('carnetfrontal')->nullable();
            $table->string('carnetfrontalempresa')->nullable();
            $table->string('primerainscripcion')->nullable();
            $table->string('compranotarial')->nullable();
            $table->string('padron')->nullable();
            $table->string('cav')->nullable();
            $table->string('tagentregado')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
};
