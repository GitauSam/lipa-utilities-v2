<?php

namespace App\Http\Controllers\Utility;

use App\Http\Controllers\Controller;
use App\Http\Requests\Utility\CreateUtilityRequest;
use App\Models\TransactionLog\TransactionLog;
use App\Modules\Utility\UtilityActivator;
use App\Modules\Utility\UtilityPaymentMethodActivator;
use Illuminate\Http\Request;

class UtilityController extends Controller
{

    public function __construct()
    {
        
        $this->activator = new UtilityActivator();
        $this->utilityPaymentMethodActivator = new UtilityPaymentMethodActivator();

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('utility.index', 
                        ['notifications' => auth()->user()->unreadNotifications]
                    );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

       return view('utility.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUtilityRequest $request)
    {
        $validated = $request->validated();

        $transactionLog = new TransactionLog();

        if (in_array('M-Pesa', $request['utility_payment_methods']))
        {
            if ($request['paybill_number'] == null)
            {
                return redirect()->back()->withErrors('Paybill number is required');
            }
        }

        $transactionLog->event = "admin create utility process";
        $transactionLog->transaction_response = "Admin create utility process started.";
        $transactionLog->save();

        $utility = $this->activator->saveUtility($validated, $transactionLog);

        foreach($request['utility_payment_methods'] as $name) 
        {
            if ($name == 'M-Pesa')
            {
                $this
                    ->utilityPaymentMethodActivator
                    ->saveUtilityPaymentMethod($utility, $name, $request['paybill_number'], $transactionLog);
            } else
            {
                $this
                    ->utilityPaymentMethodActivator
                    ->saveUtilityPaymentMethod($utility, $name, null, $transactionLog);
            }
        }

        if ($transactionLog->transaction_status == '30')
        {
            $status = "success_notif";
            $message = "Utility: " . $utility->utility_name . " created successfully.";
        } else
        {
            $status = "failure_notif";
            $message = "Could not create utility: " . $validated['utility_name'] . ".";
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
