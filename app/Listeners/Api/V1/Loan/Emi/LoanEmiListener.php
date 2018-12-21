<?php

namespace App\Listeners\Api\V1\Loan\Emi;

use App\Notifications\Api\V1\Client\LoanEmiPaidNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LoanEmiListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param $eventData
     */
    public function onPaid($eventData)
    {
        if(!empty($eventData->loanEMi)){
            $eventData->loanEMi->client->nofify(new LoanEmiPaidNotification($eventData->loanProposal));
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Api\V1\Loan\Emi\EmiPaidEvent::class,
            'App\Listeners\Api\V1\Loan\Emi\LoanEmiListener@onPaid'
        );

    }
}
