<?php

namespace App\Models\EventLog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventLog extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'transaction_log_id',
        'event_name',
        'event_response',
        'event_status'
    ];

    public function transactionLog()
    {

        $this->belongsTo('App\Models\TransactionLog\TransactionLog');

    }

}
