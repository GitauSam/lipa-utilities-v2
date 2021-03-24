<?php

namespace App\Http\Integrations;

use App\Exceptions\General\CouldNotGetCurrentTimeException;
use App\Exceptions\Mpesa\CouldNotGenerateAccessTokenException;
use App\Exceptions\Mpesa\CouldNotGeneratePasswordException;
use App\Exceptions\Mpesa\InvalidAmountException;
use App\Models\TransactionLog\TransactionLog;
use App\Modules\Utility\UtilityActivator;
use App\Modules\Utils\Utils;
use Illuminate\Support\Facades\Http;

class LipaNaMpesa 
{

    use Utils;

    public function __construct()
    {
        $this->utilityActivator = new UtilityActivator();
    }

    public function pay($amount, $paybillNo, $accountReference, $user_utility_id) 
    {

        $transactionLog = new TransactionLog();
        $transactionLog->event = 'lipa na mpesa';
        $transactionLog->transaction_status = '0';
        $transactionLog->transaction_response = 'Started lipa na mpesa transaction.';
        $transactionLog->user_id = auth()->user()->id;
        $transactionLog->save();

        try 
        {
            
            if ($amount < 1) 
            {
                
                $transactionLog->transaction_response = $transactionLog->transaction_response . 
                    " Amount is invalid. Less than KES 1. Current value: KES " . $amount . ".";
                $transactionLog->transaction_status = '25';
                $transactionLog->save();

                throw new InvalidAmountException("Amount payable should be greater than KES 1. Current input: KES " . $amount . "."); 
            
            } 
            else 
            {

                $transactionLog->transaction_response = $transactionLog->transaction_response . 
                    " Attempting to pay: KES " . $amount . ".";
                $transactionLog->transaction_amount = $amount;
                $transactionLog->save();

            }

            $paybillNo = $this->decrypt($paybillNo);

            $accountReference = $this->decrypt($accountReference);

            $currentTime = $this->getCurrentDate
                                            (
                                                config('services.mpesa.timestamp_format'), 
                                                $transactionLog
                                            );

            if (!$currentTime) 
            {

                $transactionLog->transaction_status = '25';
                $transactionLog->save();

                throw new CouldNotGetCurrentTimeException("Unable to get current timestamp for use in mpesa payload.");

            }

            $password = $this->returnEncodedValue
                                            (
                                                config('services.mpesa.encoding_format'), 
                                                array(
                                                    $paybillNo,
                                                    config('services.mpesa.lipa_na_mpesa_passkey'),
                                                    $currentTime
                                                ),
                                                $transactionLog
                                            );

            if (!$password) 
            {

                $transactionLog->transaction_status = '25';
                $transactionLog->save();

                throw new CouldNotGeneratePasswordException("Unable to generate mpesa password.");

            }

            $token = MpesaOauthToken::getToken($transactionLog);
            
            if (!$token) 
            {

                $transactionLog->transaction_status = '25';
                $transactionLog->save();

                throw new CouldNotGenerateAccessTokenException("Unable to generate mpesa access token.");

            }

            $transactionDesc = substr(md5(time()), 0, 16);

            $transactionLog->user_utility_id = $this->decrypt($user_utility_id);
            $transactionLog->business_short_code = $paybillNo;
            $transactionLog->mpesa_party_a = auth()->user()->phone_number;
            $transactionLog->mpesa_party_b = $paybillNo;
            $transactionLog->mpesa_transaction_type = config('services.mpesa.paybill_transaction_type');
            $transactionLog->mpesa_sender_msisdn = auth()->user()->phone_number;
            $transactionLog->mpesa_account_ref = $accountReference;
            $transactionLog->mpesa_transaction_desc = $transactionDesc;
            $transactionLog->save();

            $request_array = [
                                'BusinessShortCode' => $paybillNo,
                                'Password' => $password,
                                'Timestamp' => $currentTime,
                                'TransactionType' => config('services.mpesa.paybill_transaction_type'),
                                'Amount' => $amount,
                                'PartyA' => auth()->user()->phone_number,
                                'PartyB' => $paybillNo,
                                'PhoneNumber' => auth()->user()->phone_number,
                                'CallBackURL' => config('services.mpesa.paybill_callback_url'),
                                'AccountReference' => $accountReference,
                                'TransactionDesc' => $transactionDesc
                            ];

                            
            $transactionLog->mpesa_integration_request = json_encode($request_array);
            $transactionLog->save();

            $response = Http::withToken($token)
                            ->post(config('services.mpesa.lipa_na_mpesa_url'), $request_array);

            if ($response == null || empty($response) ) 
            {

                $transactionLog->transaction_status = '20';
                $transactionLog->transaction_response = $transactionLog->transaction_response . 
                                                            ' Lipa na mpesa response is empty.';
                $transactionLog->save();

            } 
            else if ($response['ResponseCode'] != config('services.mpesa.lipa_na_mpesa_success_code')) 
            {

                $transactionLog->mpesa_merchant_response_id = $response['MerchantRequestID'];
                $transactionLog->mpesa_checkout_response_id = $response['CheckoutRequestID'];
                $transactionLog->mpesa_response_code = $response['ResponseCode'];
                $transactionLog->mpesa_response_description = $response['ResponseDescription'];
                $transactionLog->mpesa_customer_message = $response['CustomerMessage'];
                $transactionLog->mpesa_integration_response = $response->body();
                $transactionLog->transaction_status = '20';
                $transactionLog->transaction_response = $transactionLog->transaction_response . 
                                                            ' Lipa na mpesa transaction failed.';
                $transactionLog->save();

            } 
            else 
            {
            
                $transactionLog->mpesa_merchant_response_id = $response['MerchantRequestID'];
                $transactionLog->mpesa_checkout_response_id = $response['CheckoutRequestID'];
                $transactionLog->mpesa_response_code = $response['ResponseCode'];
                $transactionLog->mpesa_response_description = $response['ResponseDescription'];
                $transactionLog->mpesa_customer_message = $response['CustomerMessage'];
                $transactionLog->mpesa_integration_response = $response->body();
                $transactionLog->transaction_status = '30';
                $transactionLog->transaction_response = $transactionLog->transaction_response . 
                                                            ' Successfully completed lipa na mpesa transaction';
                $transactionLog->save();
            
            }

        } 
        catch (\Exception $e) 
        {

            $transactionLog->transaction_response = $transactionLog->transaction_response . 
                                                        ' Unable to complete lipa na mpesa transaction. '
                                                        . 'Error: ' . $e->getMessage() . ".";
            $transactionLog->transaction_status = '25';

            $transactionLog->save();

        }

        return $transactionLog->transaction_status;

    }
}