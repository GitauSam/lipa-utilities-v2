<?php

namespace App\Modules\Mpesa;

use App\Exceptions\Mpesa\InvalidLipaNaMpesaCallbackResponse;
use App\Models\EventLog\EventLog;
use App\Models\Mpesa\MpesaCallbackResponse;
use App\Modules\TransactionLogActivator\TransactionLogActivator;
use App\Modules\Utility\UtilityActivator;
use App\Modules\Utility\UtilityPaymentActivator;
use App\Modules\Utils\Utils;
use App\Notifications\UtilityPayment\FailedPaymentNotification;
use App\Notifications\UtilityPayment\MpesaPaymentCancelledByUserNotification;
use App\Notifications\UtilityPayment\MpesaSuccessfulPaymentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MpesaActivator
{

    public function __construct()
    {
        $this->utilityPaymentActivator = new UtilityPaymentActivator();
    }

    use Utils;

    public function processLipaNaMpesaCallbackResponse(Request $request) 
    {

        $eventLog = new EventLog();
        $eventLog->event_name = 'lipa na mpesa callback response receipt process';
        $eventLog->event_response = 'Started callback response receipt process.';
        $eventLog->save();

        Log::debug('Event log ID: ' . $eventLog->id);
        
        try 
        {

            $this->validateLipaNaMpesaCallbackResponse($request);

            $transactionLog = TransactionLogActivator::getTransactionLogByMpesaMerchantResponseIdAndMpesaCheckoutResponseId(
                                                            $request->input('Body')['stkCallback']['MerchantRequestID'], 
                                                            $request->input('Body')['stkCallback']['CheckoutRequestID']);

            $transactionLog->event = $transactionLog->event . "-lipa na mpesa callback response";
            $transactionLog->mpesa_callback_merchant_response_id = $request->input('Body')['stkCallback']['MerchantRequestID'];
            $transactionLog->mpesa_callback_checkout_response_id = $request->input('Body')['stkCallback']['CheckoutRequestID'];
            $transactionLog->mpesa_callback_result_code = $request->input('Body')['stkCallback']['ResultCode'];
            $transactionLog->mpesa_callback_result_desc = $request->input('Body')['stkCallback']['ResultDesc'];

            $mpesaCallbackResp = new MpesaCallbackResponse();
            $mpesaCallbackResp->merchant_request_id = $request->input('Body')['stkCallback']['MerchantRequestID'];
            $mpesaCallbackResp->checkout_request_id = $request->input('Body')['stkCallback']['CheckoutRequestID'];
            $mpesaCallbackResp->result_code = $request->input('Body')['stkCallback']['ResultCode'];
            $mpesaCallbackResp->result_desc = $request->input('Body')['stkCallback']['ResultDesc'];

            if ($transactionLog->mpesa_callback_result_code == config('services.mpesa.lipa_na_mpesa_success_code'))
            {

                foreach($request->input('Body')['stkCallback']['CallbackMetadata']['Item'] as $callbackMetadata)
                {

                    if ($callbackMetadata['Name'] == 'Amount')
                    {

                        $transactionLog->mpesa_callback_response_amount = $callbackMetadata['Value'];
                        $mpesaCallbackResp->mpesa_callback_response_amount = $callbackMetadata['Value'];

                    } else if ($callbackMetadata['Name'] == 'MpesaReceiptNumber')
                    {

                        $transactionLog->mpesa_callback_response_receipt_number = $callbackMetadata['Value'];
                        $mpesaCallbackResp->mpesa_callback_response_receipt_number = $callbackMetadata['Value'];

                    } else if ($callbackMetadata['Name'] == 'TransactionDate')
                    {

                        $transactionLog->mpesa_callback_response_transaction_date = $callbackMetadata['Value'];
                        $mpesaCallbackResp->mpesa_callback_response_transaction_date = $callbackMetadata['Value'];

                    } else if ($callbackMetadata['Name'] == 'PhoneNumber')
                    {

                        $transactionLog->mpesa_callback_response_phone_number = $callbackMetadata['Value'];
                        $mpesaCallbackResp->mpesa_callback_response_phone_number = $callbackMetadata['Value'];

                    } 

                }

            }

            $transactionLog->mpesa_callback_response = json_encode($request->all());

            $transactionLog->transaction_response = $transactionLog->transaction_response 
                                                        . ' Successfully received callback response.'
                                                        . ' Response: ' . json_encode($request->all()) . ".";

            $transactionLog->mpesa_callback_response_status = '30';
            $transactionLog->save();

            $mpesaCallbackResp->callback_response = json_encode($request->all());
            $mpesaCallbackResp->save();

            $eventLog->transaction_log_id = $transactionLog->id;
            $eventLog->event_response .= " Successfully received mpesa callback response. Response: "
                                            . json_encode($request->all()) . ".";

            $eventLog->event_status = '30';
            $eventLog->save();

            $this->utilityPaymentActivator->saveUtilityPayment($transactionLog);

            if (!$this->isNullOrEmptyString($transactionLog->mpesa_callback_result_code))
            {

                switch($transactionLog->mpesa_callback_result_code)
                {

                    case config('services.mpesa.lipa_na_mpesa_success_code'):

                        $transactionLog
                            ->user
                            ->notify(new MpesaSuccessfulPaymentNotification(
                                        $transactionLog->transaction_amount, 
                                        $transactionLog->userUtility->utility->utility_name
                                    ));

                        break;

                    case config('services.mpesa.lipa_na_mpesa_callback_user_cancelled_code'):

                        $transactionLog
                            ->user
                            ->notify(new MpesaPaymentCancelledByUserNotification(
                                        $transactionLog->transaction_amount, 
                                        $transactionLog->userUtility->utility->utility_name
                                    ));

                        break;
                    
                    default:

                        $transactionLog
                            ->user
                            ->notify(new FailedPaymentNotification(
                                        $transactionLog->transaction_amount, 
                                        $transactionLog->userUtility->utility->utility_name
                                    ));

                        break;

                }

            }

        } catch (InvalidLipaNaMpesaCallbackResponse $e) 
        {

            $eventLog->event_response = $eventLog->event_response 
                                                        . ' Received invalid lipa na mpesa callback response. Error: '
                                                        . $e->getMessage() . '. Response: ' . json_encode($request->all()) . '.';

            $eventLog->event_status = '25';
            $eventLog->save();

        } 
        catch (\Exception $e) 
        {

            $eventLog->event_response = $eventLog->event_response 
                                                        . ' Error occured while receiving callback response. Error: '
                                                        . $e->getMessage()
                                                        . ' .Received response: ' . json_encode($request->all()) . ".";

            $eventLog->event_status = '25';
            $eventLog->save();

        }

    }

}