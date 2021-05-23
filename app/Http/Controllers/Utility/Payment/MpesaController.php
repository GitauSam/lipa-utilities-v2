<?php

namespace App\Http\Controllers\Utility\Payment;

use App\Http\Controllers\Controller;
use App\Http\Integrations\LipaNaMpesa;
use App\Http\Requests\Utility\LipaNaMpesaRequest;
use App\Jobs\Mpesa\SendLipaNaMpesaRequest;
use App\Modules\Mpesa\MpesaActivator;
use App\Modules\Utility\UtilityActivator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MpesaController extends Controller
{

    public function __construct()
    {
        $this->utilityActivator = new UtilityActivator();
        $this->lipaNaMpesa = new LipaNaMpesa();
        $this->mpesaActivator = new MpesaActivator();
    }

    public function showLipaNaMpesa($id)
    {

        $s = $this->utilityActivator->getPayUserUtilityWithMpesa($id);

        if ($s != null && is_array($s) && count($s) == 2 && $s['status'] == '30')
        {

            return view('utility.user.lipa-na-mpesa', [ 'u' => $s['utility'] ]);

        } else
        {

            $status = "failure_notif";
            $message = "Could not pay for utility. Please contact support.";

            return redirect()->route('utility.index')->with($status, $message);

        }

    }

    public function executeLipaNaMpesaTransaction(LipaNaMpesaRequest $request)
    {
        $validated = $request->validated();

        SendLipaNaMpesaRequest::dispatchAfterResponse(
            $validated['amount'], 
            $validated['pbno'], 
            $validated['acc_ref'],
            $validated['utility_id']
        );

        $status = "success_notif";
        $message = "Your payment transaction has been queued. Awaiting user confirmation.";

        return redirect()->route('utility.index')->with($status, $message);
    }

    public function receiveCallbackResponse(Request $request) 
    {

        Log::debug('Received mpesa callback response');
        Log::debug($request->input());

        $this->mpesaActivator->processLipaNaMpesaCallbackResponse($request);

        Log::debug('Finished processing callback response');

    }

}