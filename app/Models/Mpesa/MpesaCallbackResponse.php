<?php

namespace App\Models\Mpesa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MpesaCallbackResponse extends Model
{
    use HasFactory; 

    protected $fillable = [
        'merchant_request_id',
        'checkout_request_id',
        'result_code',
        'result_desc',
        'mpesa_callback_response_amount',
        'mpesa_callback_response_receipt_number',
        'mpesa_callback_response_transaction_date',
        'mpesa_callback_response_phone_number',
        'callback_response'
    ];
}
