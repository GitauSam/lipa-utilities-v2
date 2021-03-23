<?php

namespace App\Modules\Utility;

use App\Models\EventLog\EventLog;
use App\Models\Utility\Repository\UtilityPaymentMethodRepository;

class UtilityPaymentMethodActivator
{

    public function __construct()
    {
        $this->repository = new UtilityPaymentMethodRepository();
    }

    public function saveUtilityPaymentMethod($utility, $name, $paybillNo = null, $transactionLog)
    {
        $eventLog = new EventLog();
        $eventLog->event_name = 'create utility payment method process';
        $eventLog->event_response = 'Create utility payment method process started.';
        $eventLog->save();

        try
        {
            $eventLog->transaction_log_id =  $transactionLog->id;
            $eventLog->save();

            $utilityPaymentMethod = $this->repository->save($utility->id, $name, $paybillNo);

            $transactionLog->transaction_status= '30';
            $transactionLog->transaction_response .= " Created utility payment method: " 
                                                        . $utilityPaymentMethod['payment_method_name']
                                                        . " for utility: "
                                                        . $utility->utility_name
                                                        . " successfully.";
            $transactionLog->save();

            $eventLog->event_response .= " Created utility payment method: " 
                                                        . $utilityPaymentMethod['payment_method_name']
                                                        . " for utility: "
                                                        . $utility->utility_name
                                                        . " successfully.";
            $eventLog->event_status = '30';
            $eventLog->save();

            return $utilityPaymentMethod;
        } catch (\Exception $e) 
        {

            $transactionLog->transaction_status= '25';
            $transactionLog->transaction_response .= " Failed to create utility payment method: "
                                                        . $name
                                                        ." for utility: "
                                                        . $utility->utility_name
                                                        .". Error: "
                                                        . $e->getMessage() . ".";
            $transactionLog->save();

            $eventLog->event_response .= " Failed to create utility payment method: "
                                                        . $name
                                                        ." for utility: "
                                                        . $utility->utility_name
                                                        .". Error: "
                                                        . $e->getMessage() . ".";
            $eventLog->event_status = '25';
            $eventLog->save();

        }
    }

    public function deactivateUtilityPaymentMethod($utility, $utilityPaymentMethod, $transactionLog)
    {
        $eventLog = new EventLog();
        $eventLog->event_name = 'deactivate utility payment method process';
        $eventLog->event_response = 'Deactivate utility payment method process started.';
        $eventLog->save();

        try
        {
            $eventLog->transaction_log_id =  $transactionLog->id;
            $eventLog->save();

            $utilityPaymentMethod = $this->repository->deactivate($utilityPaymentMethod);

            $transactionLog->transaction_status= '30';
            $transactionLog->transaction_response .= " Deactivated utility payment method: " 
                                                        . $utilityPaymentMethod->payment_method_name
                                                        . " for utility: "
                                                        . $utility->utility_name
                                                        . " successfully.";
                                                        
            $transactionLog->save();

            $eventLog->event_response .= " Deactivated utility payment method: " 
                                                        . $utilityPaymentMethod->payment_method_name
                                                        . " for utility: "
                                                        . $utility->utility_name
                                                        . " successfully.";
            $eventLog->event_status = '30';
            $eventLog->save();

            return $utilityPaymentMethod;
        } catch (\Exception $e) 
        {

            $transactionLog->transaction_status= '25';
            $transactionLog->transaction_response .= " Failed to deactivate utility payment method: "
                                                        ." for utility: "
                                                        . $utility->utility_name
                                                        .". Error: "
                                                        . $e->getMessage() . ".";
            $transactionLog->save();

            $eventLog->event_response .= " Failed to deactivate utility payment method: "
                                                        ." for utility: "
                                                        . $utility->utility_name
                                                        .". Error: "
                                                        . $e->getMessage() . ".";
            $eventLog->event_status = '25';
            $eventLog->save();

        }
    }

    public function reactivateUtilityPaymentMethod($utility, $utilityPaymentMethod, $paybillNo = null, $transactionLog)
    {
        $eventLog = new EventLog();
        $eventLog->event_name = 'reactivate utility payment method process';
        $eventLog->event_response = 'Reactivate utility payment method process started.';
        $eventLog->save();

        try
        {
            $eventLog->transaction_log_id =  $transactionLog->id;
            $eventLog->save();

            $utilityPaymentMethod = $this->repository->reactivate($utilityPaymentMethod, $paybillNo);

            $transactionLog->transaction_status= '30';
            $transactionLog->transaction_response .= " Reactivated utility payment method: " 
                                                        . $utilityPaymentMethod->payment_method_name
                                                        . " for utility: "
                                                        . $utility->utility_name
                                                        . " successfully.";
            $transactionLog->save();

            $eventLog->event_response .= " Reactivated utility payment method: " 
                                                        . $utilityPaymentMethod->payment_method_name
                                                        . " for utility: "
                                                        . $utility->utility_name
                                                        . " successfully.";
            $eventLog->event_status = '30';
            $eventLog->save();

            return $utilityPaymentMethod;
        } catch (\Exception $e) 
        {

            $transactionLog->transaction_status= '25';
            $transactionLog->transaction_response .= " Failed to reactivate utility payment method: "
                                                        ." for utility: "
                                                        . $utility->utility_name
                                                        .". Error: "
                                                        . $e->getMessage() . ".";
            $transactionLog->save();

            $eventLog->event_response .= " Failed to reactivate utility payment method: "
                                                        ." for utility: "
                                                        . $utility->utility_name
                                                        .". Error: "
                                                        . $e->getMessage() . ".";
            $eventLog->event_status = '25';
            $eventLog->save();

        }
    }

}

?>