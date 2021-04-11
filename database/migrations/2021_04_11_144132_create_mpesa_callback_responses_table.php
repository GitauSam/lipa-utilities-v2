<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMpesaCallbackResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpesa_callback_responses', function (Blueprint $table) {
            $table->id();
            $table->string('merchant_request_id');
            $table->string('checkout_request_id');
            $table->string('result_code');
            $table->string('result_desc');
            $table->string('mpesa_callback_response_amount')->nullable();
            $table->string('mpesa_callback_response_receipt_number')->nullable();
            $table->string('mpesa_callback_response_transaction_date')->nullable();
            $table->string('mpesa_callback_response_phone_number')->nullable();
            $table->string('callback_response', 65000);
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
        Schema::dropIfExists('mpesa_callback_responses');
    }
}
