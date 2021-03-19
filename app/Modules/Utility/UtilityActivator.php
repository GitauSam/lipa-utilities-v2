<?php

namespace App\Modules\Utility;

use App\Models\EventLog\EventLog;
use App\Models\Utility\Repository\UtilityRepository;

class UtilityActivator 
{

    public function __construct()
    {
        
        $this->utilityRepository = new UtilityRepository;
    
    }

    public function getAllActiveUtilities($transactionLog) 
    {
        
        $eventLog = new EventLog();
        $eventLog->event_name = 'fetch all active utilities process';
        $eventLog->event_response = 'Fetch all active utilities process started.';
        $eventLog->save();
        
        try
        {

            $eventLog->transaction_log_id =  $transactionLog->id;
            $eventLog->save();

            $utilities = $this->utilityRepository->fetchAllActiveUtilities();

            $transactionLog->transaction_status= '30';
            $transactionLog->transaction_response .= " Fetched all active utilities successfully.";
            $transactionLog->save();

            $eventLog->event_response .= " Fetched all active utilities successfully.";
            $eventLog->event_status = '30';
            $eventLog->save();

            return $utilities;

        } catch (\Exception $e) 
        {

            $transactionLog->transaction_status= '25';
            $transactionLog->transaction_response .= " Failed to fetch all active utilities. Error: "
                                                        . $e->getMessage() . ".";
            $transactionLog->save();

            $eventLog->event_response .= " Failed to fetch all active utilities. Error: "
                                            . $e->getMessage() . ".";
            $eventLog->event_status = '25';
            $eventLog->save();

        }

    }

}

?>