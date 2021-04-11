<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtilityPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_log_id',
        'user_id',
        'amount_paid',
        'payment_date'
    ];

    public function transactionLog() {
        return $this->belongsTo('App\Models\TransactionLog\TransactionLog');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
