<?php

namespace App\Modules\TransactionLogActivator;

use App\Models\TransactionLog\Repository\TransactionLogRepository;

class TransactionLogActivator {

    public static function getTransactionLogByMpesaMerchantResponseIdAndMpesaCheckoutResponseId($merchantId, $checkoutId) 
    {

        return TransactionLogRepository::fetchTransactionLogByMpesaMerchantResponseIdAndMpesaCheckoutResponseId($merchantId, $checkoutId);
    
    }

}

?>