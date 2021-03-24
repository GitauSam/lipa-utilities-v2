<?php

namespace App\Http\Integrations;

use App\Models\TransactionLog\TransactionLog;
use Illuminate\Support\Facades\Http;

class MpesaOauthToken{
    public static function getToken(TransactionLog $transactionLog) {

        try {

            $token = Http::withBasicAuth
                            (
                                config('services.mpesa.lipia_utilities_consumer_key'), 
                                config('services.mpesa.lipia_utilities_consumer_secret')
                            )
                            ->get(config('services.mpesa.access_token_url'))
                            ->json()['access_token'];

            $transactionLog->transaction_response = $transactionLog->transaction_response . 
                " Successfully generated mpesa oauth token. " .
                "Token: " . $token . ".";
            $transactionLog->mpesa_oauth_token = $token;
            $transactionLog->mpesa_oauth_token_status = '30';
            $transactionLog->save();

            return $token;

        } catch (\Exception $e) {

            $transactionLog->transaction_response = $transactionLog->transaction_response . 
                " Exception occured while generating mpesa oauth token. " .
                "Error: " . $e->getMessage() . ".";
            $transactionLog->mpesa_oauth_token_status = '25';
            $transactionLog->save();

            return 0;

        }

    }
}