<?php

namespace App\Http\Resources\Api\V1\Loan\Emi;

use App\Http\Resources\Api\V1\Loan\Proposal\LoanProposalResource;
use App\Http\Resources\Api\V1\Loan\Type\LoanTypeResource;
use App\Http\Resources\Api\V1\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LoanEmiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'loan_proposal_id' => $this->loan_proposal_id,
            'loan_type_id' => $this->loan_type_id,
            'interest_rate' => $this->interest_rate,
            'remaining_amount' => $this->remaining_amount,
            'emi_amount' => $this->emi_amount,
            'is_paid' => $this->is_paid,
            'is_enable' => $this->is_enable,
            'date_of_emi' => $this->date_of_emi,
            'is_forget_to_pay' => $this->is_forget_to_pay,
            'penalty_amount' => $this->penalty_amount,
            'client' =>  new UserResource($this->whenLoaded('client')),
            'type' =>  new LoanTypeResource($this->whenLoaded('type')),
            'proposal' =>  new LoanProposalResource($this->whenLoaded('proposal')),
        ];
    }
}
