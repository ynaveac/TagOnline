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
        Schema::create('transbanks', function (Blueprint $table) {
            
            $table->id();
            $table->timestamps();
            $table->string('sessionId')->nullable();
            $table->biginteger('total')->default(0);
            $table->string('estado')->default(0);
            $table->string('vci')->nullable();
            $table->string('status')->nullable();
            $table->integer('responseCode')->default(0);
            $table->integer('amount')->default(0);
            $table->string('authorizationCode')->nullable();
            $table->string('paymentTypeCode')->nullable();
            $table->string('accountingDate')->nullable();
            $table->string('installmentsNumber')->nullable();
            $table->string('installmentsAmount')->nullable();
            $table->string('buyOrder')->nullable();
            $table->string('cardNumber')->nullable();
            $table->text('cardDetail')->nullable();
            $table->string('transactionDate')->nullable();
            $table->string('balance')->nullable();
            $table->text('token_ws')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transbanks');
    }
};
