<?php

namespace App\Models\Utility\Repository;

use App\Models\Utility\UtilityPayment;
use Carbon\Carbon;

class UtilityPaymentRepository {

    public function __construct()
    {
        $this->model = new UtilityPayment();
    }

    public function save($t, $amt, $payment_date)
    {
        return $this->model
                    ->create(
                        array(
                            "transaction_log_id" => $t,
                            "amount_paid" => $amt, 
                            "user_id" => 1,
                            "payment_date" => Carbon::createFromFormat(
                                                            config('services.mpesa.timestamp_format'), 
                                                            $payment_date, 
                                                            'UTC'
                                                    )
                                                    ->toDateTimeString()
                        )
                    );
    }

    public function fetchAllUserUtilityPayments()
    {

        return $this
                    ->model::where('user_id', '=', auth()->user()->id)
                    ->paginate(2);

    }

    public function fetchAllUtilityPayments()
    {

        return $this
                    ->model::orderBy('created_at', 'DESC')
                    ->paginate(3);

    }
}

?>