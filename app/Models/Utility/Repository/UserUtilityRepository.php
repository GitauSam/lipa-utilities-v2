<?php 

namespace App\Models\Utility\Repository;

use App\Exceptions\Utility\CouldNotCreateUtilityException;
use App\Exceptions\Utility\CouldNotFetchUtilitiesException;
use App\Exceptions\Utility\CouldNotUpdateUtilityException;
use App\Models\Utility\UserUtility;
use Illuminate\Database\QueryException;

class UserUtilityRepository 
{

    public function __construct()
    {
        $this->model = new UserUtility();
    }

    public function save($u, $data)
    {
        try 
        {
            return $this->model
                            ->create(
                                array(
                                    'user_id' => auth()->user()->id,
                                    'utility_id' => $u,
                                    'kenya_power_meter_number' => $data['kp_meter_number'],
                                    'status' => 1
                                )
                            );

        } catch (QueryException $e)
        {
            throw new CouldNotCreateUtilityException("Unable to create new utility. Error: " . $e->getMessage());
        } catch (\Exception $e)
        {
            throw new CouldNotCreateUtilityException("Unable to create new utility. Error: " . $e->getMessage());
        }
    }

    public function fetchAllActiveUserUtilities()
    {
        try 
        {
            return $this->model::where(
                            [
                                ['status', '=', 1],
                                ['user_id', '=', auth()->user()->id]
                            ]
                        )
                        ->orderBy('created_at', 'DESC');
        } catch (QueryException $e)
        {
            throw new CouldNotFetchUtilitiesException("Unable to fetch all user utilities. Error: " . $e->getMessage());
        } catch (\Exception $e)
        {
            throw new CouldNotFetchUtilitiesException("Unable to fetch all user utilities. Error: " . $e->getMessage());
        }

    }

    public function fetchById($id)
    {
        try
        {
            return $this->model::findOrFail($id);
        } catch (QueryException $e)
        {
            throw new CouldNotFetchUtilitiesException("Unable to fetch user utility with id: "
                                                        . $id 
                                                        . ". Error: " . $e->getMessage());
        } catch (\Exception $e)
        {
            throw new CouldNotFetchUtilitiesException("Unable to fetch user utility with id: "
                                                        . $id 
                                                        . ". Error: " . $e->getMessage());
        }
    }

    public function fetchUserUtilityByUserAndUtility($id)
    {
        try 
        {
        
            return $this->model::where(
                            [
                                ['status', '=', 1],
                                ['user_id', '=', auth()->user()->id],
                                ['utility_id', '=', $id]
                            ]
                        );

        } catch (QueryException $e)
        {
            throw new CouldNotFetchUtilitiesException("Unable to fetch all user utility. Error: " . $e->getMessage());
        } catch (\Exception $e)
        {
            throw new CouldNotFetchUtilitiesException("Unable to fetch all user utility. Error: " . $e->getMessage());
        }
    }

    public function update($userUtility, $u)
    {
        try 
        {
            $userUtility->kenya_power_meter_number = $u['kp_meter_number'];
            $userUtility->save();

            return $userUtility;

        } catch (QueryException $e)
        {
            throw new CouldNotUpdateUtilityException("Unable to update user utility with id: "
                                                        . $userUtility->id . ". Error: " 
                                                        . $e->getMessage());
        } catch (\Exception $e)
        {
            throw new CouldNotUpdateUtilityException("Unable to update user utility with id: "
                                                        . $userUtility->id . ". Error: " 
                                                        . $e->getMessage());
        }

    }

}

?>