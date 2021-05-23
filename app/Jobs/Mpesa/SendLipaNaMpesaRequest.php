<?php

namespace App\Jobs\Mpesa;

use App\Http\Integrations\LipaNaMpesa;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendLipaNaMpesaRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $amount;
    private $pbno;
    private $accRef;
    private $utilityId;

    public function __construct($amount, $pbno, $accRef, $utilityId)
    {
        $this->lipaNaMpesa = new LipaNaMpesa();
        $this->amount = $amount;
        $this->pbno = $pbno;
        $this->accRef = $accRef;
        $this->utilityId = $utilityId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this
            ->lipaNaMpesa
            ->pay(
                $this->amount,
                $this->pbno,
                $this->accRef,
                $this->utilityId
            );
    }
}
