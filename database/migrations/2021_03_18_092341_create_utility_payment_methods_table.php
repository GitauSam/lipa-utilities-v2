<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtilityPaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utility_payment_methods', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('utility_id');
            $table->foreign('utility_id')->references('id')->on('utilities');
            $table->string('payment_method_name');
            $table->string('lipa_na_mpesa_paybill')->nullable();
            $table->integer('status');
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
        Schema::dropIfExists('utility_payment_methods');
    }
}
