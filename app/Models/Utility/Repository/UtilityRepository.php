<?php

namespace App\Models\Utility\Repository;

use App\Exceptions\Utility\CouldNotCreateUtilityException;
use App\Exceptions\Utility\CouldNotFetchUtilitiesException;
use App\Exceptions\Utility\CouldNotUpdateUtilityException;
use App\Models\Utility\Utility;
use Illuminate\Database\QueryException;

class UtilityRepository
{

    public function __construct()
    {

        $this->model = new Utility();

    }

    public function save($u)
    {
        
        try 
        {
            return $this->model
                            ->create(
                                array(
                                    'utility_name' => $u['utility_name'],
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

    public function update($utility, $u)
    {

        try 
        {

            $utility->utility_name = $u['utility_name'];
            $utility->save();

            return $utility;

        } catch (QueryException $e)
        {
            
            throw new CouldNotUpdateUtilityException("Unable to update utility with id: "
                                                        . $utility->id . " and name: " 
                                                        . $utility->utility_name 
                                                        . ". Error: " . $e->getMessage());
        
        } catch (\Exception $e)
        {

            throw new CouldNotUpdateUtilityException("Unable to update utility with id: "
                                                        . $utility->id . " and name: " 
                                                        . $utility->utility_name 
                                                        . ". Error: " . $e->getMessage());
        
        }

    }

    public function fetchAll()
    {

        try 
        {

            return $this->model::orderBy('created_at', 'DESC')
                        ->paginate(3);

        } catch (QueryException $e)
        {

            throw new CouldNotFetchUtilitiesException("Unable to fetch all utilities. Error: " . $e->getMessage());
        
        } catch (\Exception $e)
        {

            throw new CouldNotFetchUtilitiesException("Unable to fetch all utilities. Error: " . $e->getMessage());
        
        }

    }

    public function fetchAllActiveUtilities()
    {

        try 
        {

            return $this->model::where('status', '=', 1)
                        ->orderBy('created_at', 'DESC');
        
        } catch (QueryException $e)
        {

            throw new CouldNotFetchUtilitiesException("Unable to fetch all utilities. Error: " . $e->getMessage());
        
        } catch (\Exception $e)
        {

            throw new CouldNotFetchUtilitiesException("Unable to fetch all utilities. Error: " . $e->getMessage());
        
        }

    }

    public function fetchById($id)
    {

        try
        {

            return $this->model::findOrFail($id);
        
        } catch (QueryException $e)
        {

            throw new CouldNotFetchUtilitiesException("Unable to fetch utility with id: "
                                                        . $id 
                                                        . ". Error: " . $e->getMessage());
        
        } catch (\Exception $e)
        {

            throw new CouldNotFetchUtilitiesException("Unable to fetch utility with id: "
                                                        . $id 
                                                        . ". Error: " . $e->getMessage());
        
        }

    }

    public function delete($u)
    {
        
        $u->status = 0;
        $u->save();

        return $u;

    }

}

?>