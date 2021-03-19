<?php

namespace App\Http\Controllers\Utility;

use App\Http\Controllers\Controller;
use App\Models\TransactionLog\TransactionLog;
use App\Modules\Utility\UtilityActivator;
use Illuminate\Http\Request;

class UtilityController extends Controller
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
        
        $activator = new UtilityActivator();

        $transactionLog = new TransactionLog();

        if (auth()->user()->hasRole('user'))
        {

            $transactionLog->event = "create-user-utility-fetch-all-active-utilities-process";
            $transactionLog->transaction_response = "Fetch all active utilities process started.";
            $transactionLog->save();

            $utilities = $activator
                            ->getAllActiveUtilities($transactionLog)
                            ->get();

            return view('utilities.create-user-utility', ['utilities' => $utilities]);
        
        } else if (auth()->user()->hasRole('moderator') || auth()->user()->hasRole('super-admin'))
        {

            return view('utilities.create');

        } else
        {

            /**
             * Return error page here
             */

        }
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
