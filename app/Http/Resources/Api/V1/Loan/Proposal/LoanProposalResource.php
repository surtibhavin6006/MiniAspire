<?php

namespace App\Http\Resources\Api\V1\Loan\Proposal;

use Illuminate\Http\Resources\Json\JsonResource;

class LoanProposalResource extends JsonResource
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
            'reason' => $this->reason,
            'documents' => $this->documents,
            'borrow_amount' => $this->borrow_amount,
            'loan_type_id' => $this->loan_type_id,
            'is_approved' => $this->is_approved,
            'decline_reason' => $this->decline_reason,
            'tenure' => $this->tenure,
            'user_id' => $this->user_id,
        ];
    }
}
