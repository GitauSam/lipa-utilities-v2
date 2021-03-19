<?php

namespace App\Http\Controllers\Utility;

use App\Exceptions\Utility\UserUtilityAlreadyExistsException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Utility\CreateUserUtilityRequest;
use App\Models\TransactionLog\TransactionLog;
use App\Modules\Utility\UtilityActivator;
use Illuminate\Http\Request;

class UserUtilityController extends Controller
{

    public function __construct()
    {
        
        $this->activator = new UtilityActivator();

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $transactionLog = new TransactionLog();

        $transactionLog->event = "create-user-utility-fetch-all-active-utilities-process";
        $transactionLog->transaction_response = "Fetch all active utilities process started.";
        $transactionLog->save();

        $utilities = $this->activator
                        ->getAllActiveUtilities($transactionLog)
                        ->get();

        return view('utilities.create-user-utility', ['utilities' => $utilities]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserUtilityRequest $request)
    {
        
        $validated = $request->validated();

        $transactionLog = new TransactionLog();

        $transactionLog->event = "create user utility process";
        $transactionLog->transaction_response = "Create user utility process started.";
        $transactionLog->save();

        $utility = $this->activator->getUtility($request->user_utility, $transactionLog);

        if ($utility->utility_name == 'Electricity')
        {
            if ($request['kp_meter_number'] == null)
            {

                $transactionLog->transaction_response .=  " Kenya power meter number is missing.";
                $transactionLog->transaction_status = 20;
                $transactionLog->save();

                return redirect()->back()->withErrors('Meter number is required');
            }
        }

        try 
        {

            $this->activator->saveUserUtility($request->input(), $transactionLog);

        } catch (UserUtilityAlreadyExistsException $e)
        {

            return redirect()->back()->withErrors('Utility already exists');
            
        }

        if ($transactionLog->transaction_status == '30')
        {
            $status = "success_notif";
            $message = "Utility created successfully.";
        } else
        {
            $status = "failure_notif";
            $message = "Could not create utility.";
        }

        return redirect()->route('utility.index')->with($status, $message);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
