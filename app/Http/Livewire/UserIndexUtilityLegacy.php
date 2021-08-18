<?php

namespace App\Http\Livewire;

use App\Models\TransactionLog\TransactionLog;
use App\Modules\Utility\UtilityActivator;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndexUtilityLegacy extends Component
{

    use WithPagination;

    public function render()
    {

        $activator = new UtilityActivator();

        $transactionLog = new TransactionLog();

        $transactionLog->event = "fetch all active user utilities process";
        $transactionLog->transaction_response = "Fetch all active user utilities process started.";
        $transactionLog->save();

        $userUtilities = $activator
                        ->getAllActiveUserUtilities($transactionLog)
                        ->paginate(3);

        return view('livewire.user-index-utility-legacy', ['userUtilities' => $userUtilities]);
    }
}
