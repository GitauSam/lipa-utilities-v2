<?php

namespace App\Modules\Utility;

use App\Exceptions\Utility\UserUtilityAlreadyExistsException;
use App\Models\EventLog\EventLog;
use App\Models\Utility\Repository\UserUtilityRepository;
use App\Models\Utility\Repository\UtilityRepository;
use App\Modules\Utils\Utils;

class UtilityActivator 
{

    use Utils;

    public function __construct()
    {
        
        $this->utilityRepository = new UtilityRepository();
        $this->userUtilityRepository = new UserUtilityRepository();
    
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

    public function getAllActiveUserUtilities($transactionLog) 
    {
        $eventLog = new EventLog();
        $eventLog->event_name = 'fetch all active user utilities process';
        $eventLog->event_response = 'Fetch all active user utilities process started.';
        $eventLog->save();
        
        try
        {

            $eventLog->transaction_log_id =  $transactionLog->id;
            $eventLog->save();

            $utilities = $this->userUtilityRepository->fetchAllActiveUserUtilities();

            $transactionLog->transaction_status= '30';
            $transactionLog->transaction_response .= " Fetched all active user utilities successfully.";
            $transactionLog->save();

            $eventLog->event_response .= " Fetched all active user utilities successfully.";
            $eventLog->event_status = '30';
            $eventLog->save();

            return $utilities;

        } catch (\Exception $e) 
        {

            $transactionLog->transaction_status= '25';
            $transactionLog->transaction_response .= " Failed to fetch all active user utilities. Error: "
                                                        . $e->getMessage() . ".";
            $transactionLog->save();

            $eventLog->event_response .= " Failed to fetch all active user utilities. Error: "
                                            . $e->getMessage() . ".";
            $eventLog->event_status = '25';
            $eventLog->save();

        }

    }

    public function getUtility($id, $transactionLog) 
    {
        $eventLog = new EventLog();
        $eventLog->event_name = 'fetch utility by id process';
        $eventLog->event_response = 'Fetch utility by id process started.';
        $eventLog->save();
        
        try
        {
            
            $id = $this->decrypt($id);

            $eventLog->transaction_log_id =  $transactionLog->id;
            $eventLog->save();

            $utility = $this->utilityRepository->fetchById($id);

            $transactionLog->transaction_status= '30';
            $transactionLog->transaction_response .= " Fetched utility with id: " 
                                                        . $id 
                                                        . " and name: " 
                                                        . $utility->utility_name
                                                        ." successfully.";
            $transactionLog->save();

            $eventLog->event_response .= " Fetched utility with id: " 
                                            . $id 
                                            . " and name: " 
                                            . $utility->utility_name
                                            ." successfully.";
            $eventLog->event_status = '30';
            $eventLog->save();

            return $utility;

        } catch (\Exception $e) 
        {

            $transactionLog->transaction_status= '25';
            $transactionLog->transaction_response .= " Failed to fetch utility by id: "
                                                        . $id 
                                                        .". Error: "
                                                        . $e->getMessage() . ".";
            $transactionLog->save();

            $eventLog->event_response .= " Failed to fetch utility by id: "
                                            . $id 
                                            .". Error: "
                                            . $e->getMessage() . ".";
            $eventLog->event_status = '25';
            $eventLog->save();

        }

    }

    public function saveUserUtility($data, $transactionLog) 
    {
        $eventLog = new EventLog();
        $eventLog->event_name = 'create user utility process';
        $eventLog->event_response = 'Create user utility process started.';
        $eventLog->save();
        
        try
        {

            $eventLog->transaction_log_id =  $transactionLog->id;
            $eventLog->save();

            $utility_id = $this->decrypt($data['user_utility']);

            if (count($this
                ->userUtilityRepository
                ->fetchUserUtilityByUserAndUtility($utility_id)
                ->get()
                ->toArray()) >= 1
            )
            {
                
                throw new UserUtilityAlreadyExistsException("User utility with id: " . $utility_id . "already exists.");

            }

            $utility = $this->userUtilityRepository->save($utility_id, $data);

            $transactionLog->transaction_status= '30';
            $transactionLog->transaction_response .= " Created user utility: " 
                                                        . $utility['id']
                                                        . " successfully.";
            $transactionLog->save();

            $eventLog->event_response .= " Created user utility: " 
                                            . $utility['id']
                                            . " successfully.";
            $eventLog->event_status = '30';
            $eventLog->save();

            return $utility;

        } catch (UserUtilityAlreadyExistsException $e) 
        {

            $transactionLog->transaction_status= '25';
            $transactionLog->transaction_response .= " Failed to create user utility. Error: "
                                                        . $e->getMessage() . ".";
            $transactionLog->save();

            $eventLog->event_response .= " Failed to create user utility. Error: "
                                            . $e->getMessage() . ".";
            $eventLog->event_status = '25';
            $eventLog->save();

            throw new UserUtilityAlreadyExistsException("User utility with id: " . $utility_id . "already exists.");

        } catch (\Exception $e) 
        {

            $transactionLog->transaction_status= '25';
            $transactionLog->transaction_response .= " Failed to create user utility. Error: "
                                                        . $e->getMessage() . ".";
            $transactionLog->save();

            $eventLog->event_response .= " Failed to create user utility. Error: "
                                            . $e->getMessage() . ".";
            $eventLog->event_status = '25';
            $eventLog->save();

        }

    }

    public function saveUtility($u, $transactionLog) 
    {
        $eventLog = new EventLog();
        $eventLog->event_name = 'create utility process';
        $eventLog->event_response = 'Create utility process started.';
        $eventLog->save();
        
        try
        {

            $eventLog->transaction_log_id =  $transactionLog->id;
            $eventLog->save();

            $utility = $this->utilityRepository->save($u);

            $transactionLog->transaction_status= '30';
            $transactionLog->transaction_response .= " Created utility: " 
                                                        . $utility['utility_name']
                                                        . " successfully.";
            $transactionLog->save();

            $eventLog->event_response .= " Created utility: " 
                                            . $utility['utility_name']
                                            . " successfully.";
            $eventLog->event_status = '30';
            $eventLog->save();

            return $utility;

        } catch (\Exception $e) 
        {

            $transactionLog->transaction_status= '25';
            $transactionLog->transaction_response .= " Failed to create utility: "
                                                        . $u['utility_name']
                                                        .". Error: "
                                                        . $e->getMessage() . ".";
            $transactionLog->save();

            $eventLog->event_response .= " Failed to create utility: "
                                            . $u['utility_name'] 
                                            .". Error: "
                                            . $e->getMessage() . ".";
            $eventLog->event_status = '25';
            $eventLog->save();

        }

    }

    public function deleteUtility($id, $transactionLog)
    {
        $eventLog = new EventLog();
        $eventLog->event_name = 'delete utility process';
        $eventLog->event_response = 'Delete utility process started.';
        $eventLog->save();
        
        try
        {

            $eventLog->transaction_log_id =  $transactionLog->id;
            $eventLog->save();
            
            $utility = $this->getUtility($id, $transactionLog);
            
            $id = $this->decrypt($id);

            $utility = $this->utilityRepository->delete($utility); 

            $transactionLog->transaction_status= '30';
            $transactionLog->transaction_response .= " Deleted utility: " 
                                                        . $utility['utility_name']
                                                        . " successfully.";
            $transactionLog->save();

            $eventLog->event_response .= " Deleted utility: " 
                                            . $utility['utility_name']
                                            . " successfully.";
            $eventLog->event_status = '30';
            $eventLog->save();

            return $utility;

        } catch (\Exception $e) 
        {

            $transactionLog->transaction_status= '25';
            $transactionLog->transaction_response .= " Failed to delete utility with ID: "
                                                        . $id
                                                        .". Error: "
                                                        . $e->getMessage() . ".";
            $transactionLog->save();

            $eventLog->event_response .= " Failed to update utility with ID: "
                                            . $id 
                                            .". Error: "
                                            . $e->getMessage() . ".";
            $eventLog->event_status = '25';
            $eventLog->save();

        }

    }

}

?>