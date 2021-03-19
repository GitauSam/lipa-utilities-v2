<?php

namespace App\Modules\Utils;

use App\Exceptions\Mpesa\InvalidLipaNaMpesaCallbackResponse;
use App\Models\TransactionLog\TransactionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

trait Utils 
{

    public function getCurrentDate($format = '', TransactionLog $transactionLog) 
    {

        try 
        {

            if (empty($format)) 
            {
                
                $ts = Carbon::now();
                
                $transactionLog->transaction_response = $transactionLog->transaction_response . 
                    " Timestamp format is empty. 
                    Generated timestamp: " .  $ts . ".";
                $transactionLog->mpesa_request_timestamp = $ts;
                $transactionLog->mpesa_request_timestamp_status = '30';
                $transactionLog->save();

                return $ts;

            }

            $ts = Carbon::now()->format($format);

            $transactionLog->transaction_response = $transactionLog->transaction_response . 
                " Timestamp format is not empty. 
                Generated timestamp: " .  $ts . ".";
            $transactionLog->mpesa_request_timestamp = $ts;
            $transactionLog->mpesa_request_timestamp_status = '30';
            $transactionLog->save();

            return $ts;

        } catch(\Exception $e) 
        {

            $transactionLog->transaction_response = $transactionLog->transaction_response . 
                " Exception occured while generating timestamp. 
                Error: " . $e . ".";
            $transactionLog->mpesa_request_timestamp_status = '25';
            $transactionLog->save();

            return 0;

        }

    }

    public function returnEncodedValue($encode_format, $items, TransactionLog $transactionLog) 
    {

        try 
        {

            if (empty($encode_format) || count($items) < 1) {

                $transactionLog->transaction_response = $transactionLog->transaction_response . 
                    " Either encoding format is empty or there are no items to encode.
                    Items to be encoded count: " . count($items) . ".";
                $transactionLog->mpesa_password_status = '20';
                $transactionLog->save();

                return 0;
            }

            switch($encode_format) {
                case "base64":

                    $encoded_value = base64_encode(join("", $items));

                    $transactionLog->transaction_response = $transactionLog->transaction_response . 
                        " Encoding items successfully. 
                        Encoded value: " . $encoded_value . ".";
                    $transactionLog->mpesa_password = $encoded_value;
                    $transactionLog->mpesa_password_status = '30';
                    $transactionLog->save();

                    return $encoded_value;
                default:

                    $transactionLog->transaction_response = $transactionLog->transaction_response . 
                        " No matching encoding format found. Encoding format: " 
                        . $encode_format . ".";
                    $transactionLog->mpesa_password_status = '20';
                    $transactionLog->save();

                    return 0;
            }

        } catch (\Exception $e) 
        {
            
            $transactionLog->transaction_response = $transactionLog->transaction_response . 
                " Could not encode the items. Error: " 
                . $e->message . ".";
            $transactionLog->mpesa_password_status = '25';
            $transactionLog->save();

            return 0;

        }

    }

    public function validateLipaNaMpesaCallbackResponse(Request $request) 
    {

        $validResponseElms = [
                                "MerchantRequestID", 
                                "CheckoutRequestID", 
                                "ResultCode", 
                                "ResultDesc",
                                "CallbackMetadata"
                            ];

        if (!$request->has('Body')) 
        {

            throw 
                new InvalidLipaNaMpesaCallbackResponse(
                        "Lipa na mpesa callback response is missing expected input Body.
                            Received response: " . json_encode($request->all())
                    );

        }

        if (!count($request->input('Body')) || count($request->input('Body')) > 1)
        {

            throw 
                new InvalidLipaNaMpesaCallbackResponse(
                        "Lipa na mpesa callback response input Body is empty or has extra unexpected values.
                            Received response: " . json_encode($request->all())
                    );

        }

        foreach($request->input('Body') as $key => $value) 
        {

            if ($key != "stkCallback") 
            {

                throw 
                    new InvalidLipaNaMpesaCallbackResponse(
                            "Lipa na mpesa callback response is missing expected input stkCallback.
                            Received response: " . json_encode($request->all())
                        );

            } else 
            {

                Log::debug('stkCallback count: ' . count($request->input('Body')['stkCallback']));

                if (!in_array(count($request->input('Body')['stkCallback']), array(4,5))) 
                {

                    throw 
                        new InvalidLipaNaMpesaCallbackResponse(
                                "Lipa na mpesa callback response input stkCallback has invalid number of expected values.
                                Received response: " . json_encode($request->all()) . 
                                " . Count: " . count($request->input('Body')['stkCallback']) . "."
                            );

                }

            }
        }

        foreach($request->input('Body')['stkCallback'] as $key => $value)
        {

            if (!in_array($key, $validResponseElms)) 
            {

                throw 
                    new InvalidLipaNaMpesaCallbackResponse(
                            "Lipa na mpesa callback response input stkCallback has an invalid key. 
                            Invalid key: " . $key . "." .
                            " Received response: " . json_encode($request->all())
                        );

            }

        }

    }

    public function encrypt($v)
    {
        return Crypt::encryptString($v);
    }

    public function decrypt($v)
    {
        return Crypt::decryptString($v);
    }

    public function isNullOrEmptyString($str)
    {
        return (!isset($str) || trim($str) === '');
    }

    public function verifyResponse($response)
    {

        return $response != null 
                && is_array($response) 
                && count($response) == 2 
                && $response['status'] == '30';
                
    }

}

?>