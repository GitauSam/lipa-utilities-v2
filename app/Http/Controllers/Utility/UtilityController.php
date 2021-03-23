<?php

namespace App\Http\Controllers\Utility;

use App\Http\Controllers\Controller;
use App\Http\Requests\Utility\CreateUtilityRequest;
use App\Http\Requests\Utility\EditUtilityRequest;
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
        
        return view('utility.admin.index', 
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

       return view('utility.admin.create');

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

        return redirect()->route('admin.utility.index')->with($status, $message);

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
        
        $transactionLog = new TransactionLog();

        $transactionLog->event = "fetch utility process (edit get)";
        $transactionLog->transaction_response = "Fetch utility process started.";
        $transactionLog->save();

        $utility = $this->activator->getUtility($id, $transactionLog);

        $u = [];
        $paymentMethods = [];
        $mpesaStatus = 0;

        if ($transactionLog->transaction_status == '30')
        {
            $u = $utility;

            foreach($u->utilityPaymentMethods as $p)
            {

                if ($p->status == 1)
                {
                    array_push($paymentMethods, $p->payment_method_name);
                }

                switch ($p->payment_method_name) {
                    
                    case 'M-Pesa':
                        $mpesaStatus = 1;
                        break;

                    default:
                        break;
                }

            }

        } 

        return view('utility.admin.edit', 
                        [
                            'utility' => $u, 
                            'paymentMethods' => $paymentMethods,
                            'mpesaStatus' => $mpesaStatus,
                        ]
                    );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUtilityRequest $request, $id)
    {
        if (in_array('M-Pesa', $request['utility_payment_methods']))
        {
            if ($request['paybill_number'] == null)
            {
                return redirect()->back()->withErrors('Paybill number is required');
            }
        }

        $validated = $request->validated();

        $transactionLog = new TransactionLog();

        $transactionLog->event = "update utility process";
        $transactionLog->transaction_response = " Update utility process started.";
        $transactionLog->save();

        $utility = $this->activator->editUtility($id, $validated, $transactionLog);

        if ($request->has('utility_payment_methods'))
        {
            $savedPaymentMethods = [];

            foreach($utility->utilityPaymentMethods as $p)
            {

                array_push($savedPaymentMethods, $p->payment_method_name);

                if (!in_array($p->payment_method_name, $validated['utility_payment_methods']))
                {

                    $transactionLog->transaction_response .= " Deactivating payment method: " 
                                                                . $p->payment_method_name 
                                                            . " of utility: " . $utility->utility_name;

                    $this
                        ->utilityPaymentMethodActivator
                        ->deactivateUtilityPaymentMethod($utility, $p, $transactionLog);

                } else 
                {
                    // if ($p->status == 0)
                    // {
                        $transactionLog->transaction_response .= " Reactivating payment method: " 
                                                                . $p->payment_method_name 
                                                            . " of utility: " . $utility->utility_name;

                        $this
                            ->utilityPaymentMethodActivator
                            ->reactivateUtilityPaymentMethod($utility, $p, $request['paybill_number'], $transactionLog);
                    // }
                }

            }

            foreach($validated['utility_payment_methods'] as $pm)
            {
                if (!in_array($pm, $savedPaymentMethods))
                {

                    $transactionLog->transaction_response .= " Adding new payment method: " 
                                                                . $pm 
                                                            . " of utility: " . $utility->utility_name;

                    if ($pm == 'M-Pesa')
                    {
                        $this
                            ->utilityPaymentMethodActivator
                            ->saveUtilityPaymentMethod($utility, $pm, $request['paybill_number'], $transactionLog);
                    } else
                    {
                        $this
                            ->utilityPaymentMethodActivator
                            ->saveUtilityPaymentMethod($utility, $pm, null, $transactionLog);
                    }

                }
            }
        }

        if ($transactionLog->transaction_status == '30')
        {
            $status = "success_notif";
            $message = "Utility: " . $utility->utility_name . " updated successfully.";
        } else
        {
            $status = "failure_notif";
            $message = "Could not update utility: " . $validated['utility_name'] . ".";
        }

        return redirect()->route('admin.utility.index')->with($status, $message);
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
