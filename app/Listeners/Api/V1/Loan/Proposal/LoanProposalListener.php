<?php

namespace App\Listeners\Api\V1\Loan\Proposal;

use App\Notifications\Api\V1\Client\LoanProposalCreateNotification;
use App\Repository\loan\Emi\LoanEmiRepository;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LoanProposalListener
{
    public $loanEmi;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(LoanEmiRepository $loanEmi)
    {
        $this->loanEmi = $loanEmi;
    }

    public function onVerified($eventData)
    {

        $loanProposal = $eventData->loanProposal;

        if(!empty($loanProposal)){

            if(!empty($loanProposal->is_approved)){

                $borrowAmount = $loanProposal->borrow_amount;
                $tenure = $loanProposal->tenure;
                $loanTypeModel = $loanProposal->type;

                $interestRate = $loanTypeModel->interest_rate;

                $emiAmountWithoutInterest = $borrowAmount/$tenure;

                $emisCreatedData = [];
                $lastAmount = $borrowAmount;
                $lastMonthDate = false;
                for($i=0;$i<$tenure;$i++){

                    $emiCreatedData = array();
                    $emiCreatedData['client_id'] = $loanProposal->user_id;
                    $emiCreatedData['loan_proposal_id'] = $loanProposal->id;
                    $emiCreatedData['loan_type_id'] = $loanProposal->loan_type_id;
                    $emiCreatedData['interest_rate'] = $interestRate;

                    $emiAmout = $emiAmountWithoutInterest+$interestRate;
                    $emiCreatedData['emi_amount'] = $emiAmout;


                    /**
                     * Taking every 5th day of month to last day to pay emi
                     */

                    $now = Carbon::now();
                    $month = $now->month;
                    $year = $now->year;
                    $date = 5;

                    if(!$lastMonthDate) {
                        $emiCreatedData['date_of_emi'] = "{$year}-{$month}-{$date}";
                    } else {
                        $emiCreatedData['date_of_emi'] = date('Y-m-d', strtotime('+1 month', strtotime($lastMonthDate)));

                    }

                    /**
                     * removing emi without interest from loan amount
                     */
                    $emiCreatedData['remaining_amount'] = $lastAmount;

                    $lastAmount = $lastAmount - $emiAmountWithoutInterest;

                    $lastMonthDate = $emiCreatedData['date_of_emi'];

                    $emisCreatedData[] = $emiCreatedData;

                }

                if(!empty($emisCreatedData)){

                    foreach ($emisCreatedData as $emi){
                        $this->loanEmi->create($emi);
                    }

                    /**
                     * Send Notification to User that Loan Is approved and show data of loan emi created
                     */

                    if(!empty($emisCreatedData)){
                        $eventData->loanProposal->client->notify(new LoanProposalCreateNotification($emisCreatedData));
                    }

                }
            }
        }
    }


    /**
     * @param $eventData
     */
    public function onRequested($eventData)
    {
        if(!empty($eventData->loanProposal)){
            $eventData->loanProposal->client->notify(new LoanProposalCreateNotification($eventData->loanProposal));
        }
    }

    /**
     * @param $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Api\V1\Loan\Proposal\ProposalVerifiedEvent::class,
            'App\Listeners\Api\V1\Loan\Proposal\LoanProposalListener@onVerified'
        );

        $events->listen(
            \App\Events\Api\V1\Loan\Proposal\ProposalRequestedEvent::class,
            'App\Listeners\Api\V1\Loan\Proposal\LoanProposalListener@onRequested'
        );

    }
}
