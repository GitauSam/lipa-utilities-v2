<?php

namespace App\Models\TransactionLog\Repository;

use App\Models\TransactionLog\TransactionLog;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TransactionLogRepository {

    public static function fetchTransactionLogByMpesaMerchantResponseIdAndMpesaCheckoutResponseId($merchantId, $checkoutId) 
    {
        $t = TransactionLog::where([
                                ['mpesa_merchant_response_id', '=', $merchantId],
                                ['mpesa_checkout_response_id', '=', $checkoutId]])
                            ->first();

        if ($t == null || empty($t)) 
        {
            throw new ModelNotFoundException("Could not find transaction log with mpesa merchant id: " 
                                                . $merchantId . " and mpesa checkout id: "
                                                . $checkoutId . ".");
        }

        return $t;
    }

}