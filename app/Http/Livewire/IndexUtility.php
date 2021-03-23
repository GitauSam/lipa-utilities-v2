<?php

namespace App\Http\Livewire;

use App\Models\TransactionLog\TransactionLog;
use App\Modules\Utility\UtilityActivator;
use App\Modules\Utils\Utils;
use Livewire\Component;
use Livewire\WithPagination;

class IndexUtility extends Component
{

    use Utils;
    use WithPagination;

    public function deleteUtility($id)
    {

        $activator = new UtilityActivator();

        $transactionLog = new TransactionLog();

        $transactionLog->event = "delete utility process";
        $transactionLog->transaction_response = "Delete utility process started.";
        $transactionLog->save();
        
        $utility = $activator->deleteUtility($id, $transactionLog);

        if ($transactionLog->transaction_status == '30')
        {
            $status = "success_notif";
            $message = "Utility: " . $utility->utility_name . " deleted successfully.";
        } else
        {
            $status = "failure_notif";
            $message = "Could not delete utility.";
        }

        session([$status, $message]);

    }

    public function render()
    {

        $activator = new UtilityActivator();

        $transactionLog = new TransactionLog();

        $transactionLog->event = "fetch all active utilities process";
        $transactionLog->transaction_response = "Fetch all active utilities process started.";
        $transactionLog->save();

        $utilities = $activator
                        ->getAllActiveUtilities($transactionLog)
                        ->paginate(3);

        return view('livewire.index-utility', ['utilities' => $utilities]);

    }
}
