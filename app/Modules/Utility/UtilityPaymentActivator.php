<?php

namespace App\Modules\Utility;

use App\Models\EventLog\EventLog;
use App\Models\TransactionLog\TransactionLog;
use App\Models\Utility\Repository\UtilityPaymentRepository;

class UtilityPaymentActivator
{

    public function __construct()
    {
        
        $this->utilityPaymentRepository = new UtilityPaymentRepository();

    }

    public function getUserUtilityPayments()
    {

        $transactionLog = new TransactionLog();

        $transactionLog->event = "fetch user utility payments process";
        $transactionLog->transaction_response = "Fetch user utility payments process started.";
        $transactionLog->save();

        $eventLog = new EventLog();
        $eventLog->event_name = 'fetch user utility payments process';
        $eventLog->event_response = 'Fetch user utility payments process started.';
        $eventLog->save();

        try
        {

            $eventLog->transaction_log_id =  $transactionLog->id;
            $eventLog->save();

            $userUtilityPayments = $this
                                        ->utilityPaymentRepository
                                        ->fetchAllUserUtilityPayments();

            $transactionLog->transaction_response .= " Fetched user utility payments successfully.";
            $transactionLog->transaction_status = "30";
            $transactionLog->save();

            $eventLog->event_response .= " Fetched user utility payments successfully.";
            $eventLog->event_status = '30';
            $eventLog->save();

        } catch (\Exception $e) 
        {

            $transactionLog->transaction_status= '25';
            $transactionLog->transaction_response .= " Failed to fetch user utility payments for user: " 
                                                        . auth()->user()->name . ". Error: "
                                                        . $e->getMessage() . ".";
            $transactionLog->save();

            $eventLog->event_response .= " Failed to fetch user utility payments for user: " 
                                            . auth()->user()->name . ". Error: "
                                            . $e->getMessage() . ".";
            $eventLog->event_status = '25';
            $eventLog->save();

        }

        if ($transactionLog->transaction_status == '30')
        {

            return array('status' => $transactionLog->transaction_status, 
                            'userUtilityPayments' => $userUtilityPayments
                        );

        }

        return array('status' => $transactionLog->transaction_status, 
                            'userUtilityPayments' => $userUtilityPayments
                        );

    }

    public function getAllUtilityPayments()
    {

        $transactionLog = new TransactionLog();

        $transactionLog->event = "fetch all utility payments process";
        $transactionLog->transaction_response = "Fetch all utility payments process started.";
        $transactionLog->save();

        $eventLog = new EventLog();
        $eventLog->event_name = 'fetch all utility payments process';
        $eventLog->event_response = 'Fetch all utility payments process started.';
        $eventLog->save();

        $utilityPayments = [];

        try
        {

            $eventLog->transaction_log_id =  $transactionLog->id;
            $eventLog->save();

            $utilityPayments = $this
                                    ->utilityPaymentRepository
                                    ->fetchAllUtilityPayments();

            $transactionLog->transaction_response .= " Fetched all utility payments successfully.";
            $transactionLog->transaction_status = "30";
            $transactionLog->save();

            $eventLog->event_response .= " Fetched all utility payments successfully.";
            $eventLog->event_status = '30';
            $eventLog->save();

        } catch (\Exception $e) 
        {

            $transactionLog->transaction_status= '25';
            $transactionLog->transaction_response .= " Failed to fetch all utility payments for user: " 
                                                        . auth()->user()->name . ". Error: "
                                                        . $e->getMessage() . ".";
            $transactionLog->save();

            $eventLog->event_response .= " Failed to fetch all utility payments for user: " 
                                            . auth()->user()->name . ". Error: "
                                            . $e->getMessage() . ".";
            $eventLog->event_status = '25';
            $eventLog->save();

        }

        if ($transactionLog->transaction_status == '30')
        {

            return array('status' => $transactionLog->transaction_status, 
                            'utilityPayments' => $utilityPayments
                        );

        }

        return array('status' => $transactionLog->transaction_status, 
                        'utilityPayments' => $utilityPayments
                    );

    }

    public function saveUtilityPayment($transactionLog) 
    {
        $eventLog = new EventLog();
        $eventLog->event_name = 'create utility payment transaction';
        $eventLog->event_response = 'Create utility payment transaction started.';
        $eventLog->save();
        
        try
        {

            $eventLog->transaction_log_id =  $transactionLog->id;
            $eventLog->save();

            $transactionLog->transaction_response .= " Create utility payment transaction started.";
            $transactionLog->save();

            $this->utilityPaymentRepository
                    ->save(
                        $transactionLog->id, 
                        $transactionLog->transaction_amount,
                        $transactionLog->mpesa_request_timestamp
                    );

            $transactionLog->transaction_status= '30';
            $transactionLog->transaction_response .= " Created utility payment transaction successfully.";
            $transactionLog->save();

            $eventLog->event_response .= " Created utility payment transaction successfully.";
            $eventLog->event_status = '30';
            $eventLog->save();

        } catch (\Exception $e) 
        {

            $transactionLog->transaction_status= '25';
            $transactionLog->transaction_response .= " Failed to create utility payment transaction. Error: "
                                                        . $e->getMessage() . ".";
            $transactionLog->save();

            $eventLog->event_response .= " Failed to create utility payment transaction. Error: "
                                                        . $e->getMessage() . ".";
            $eventLog->event_status = '25';
            $eventLog->save();

        }

    }

}

?>