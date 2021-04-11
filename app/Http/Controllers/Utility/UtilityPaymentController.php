<?php

namespace App\Http\Controllers\Utility;

use App\Http\Controllers\Controller;
use App\Modules\Utility\UtilityPaymentActivator;
use App\Modules\Utils\Utils;
use Illuminate\Http\Request;

class UtilityPaymentController extends Controller
{

    use Utils;

    public function __construct()
    {
        $this->utilityPaymentActivator = new UtilityPaymentActivator();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole(config('services.general.user_role')))
        {

            $userUtilityPaymentResponse = $this
                                            ->utilityPaymentActivator
                                            ->getUserUtilityPayments();

            if ($this->verifyResponse($userUtilityPaymentResponse))
            {

                return view(
                                'utility.payments.index', 
                                [ 'userUtilityPayments' => $userUtilityPaymentResponse['userUtilityPayments'] ]
                            );

            } else
            {

                $status = "failure_notif";
                $message = "Could not fetch utility payments. Please contact support.";

                return view(
                                'utility.payments.index', 
                                [ 'userUtilityPayments' => [] ]
                            )->with($status, $message);

            }

        } else
        {

            $utilityPaymentResponse = $this
                                            ->utilityPaymentActivator
                                            ->getAllUtilityPayments();

            if ($this->verifyResponse($utilityPaymentResponse))
            {

                return view(
                                'utility.payments.index', 
                                [ 'userUtilityPayments' => $utilityPaymentResponse['utilityPayments'] ]
                            );

            } else
            {

                $status = "failure_notif";
                $message = "Could not fetch utility payments. Please contact support.";

                return view(
                                'utility.payments.index', 
                                [ 'userUtilityPayments' => [] ]
                            )->with($status, $message);

            }

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
