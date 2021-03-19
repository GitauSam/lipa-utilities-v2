<?php

namespace App\Models\TransactionLog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionLog extends Model
{

    use HasFactory;

    protected $fillable = [
        'event',
        'business_short_code',
        'mpesa_oauth_token',
        'mpesa_oauth_token_status',
        'mpesa_password',
        'mpesa_password_status',
        'mpesa_request_timestamp',
        'mpesa_request_timestamp_status',
        'mpesa_transaction_type',
        'transaction_amount',
        'mpesa_party_a',
        'mpesa_party_b',
        'mpesa_sender_msisdn',
        'mpesa_account_ref',
        'mpesa_transaction_desc',
        'mpesa_integration_request',
        'mpesa_merchant_response_id',
        'mpesa_checkout_response_id',
        'mpesa_response_code',
        'mpesa_response_description',
        'mpesa_integration_response',
        'mpesa_customer_message',
        'mpesa_callback_merchant_response_id',
        'mpesa_callback_checkout_response_id',
        'mpesa_callback_result_code',
        'mpesa_callback_result_desc',
        'mpesa_callback_response',
        'mpesa_callback_response_status',
        'mpesa_callback_response_amount',
        'mpesa_callback_response_receipt_number',
        'mpesa_callback_response_transaction_date',
        'mpesa_callback_response_phone_number',
        'user_id',
        'utility_id',
        'user_utility_id',
        'transaction_status',
        'transaction_response'
    ];

    public function utility() 
    {

        return $this->belongsTo('App\Models\Utility\Utility');
    
    }

    public function userUtility()
    {

        return $this->belongsTo('App\Models\Utility\UserUtility');
    
    }

    public function user()
    {

        return $this->belongsTo('App\Models\User');
    
    }
    
}
