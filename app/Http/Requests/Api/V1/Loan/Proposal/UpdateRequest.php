<?php

namespace App\Http\Requests\Api\V1\Loan\Proposal;

use App\Repository\loan\Proposal\LoanProposalRepository;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * @param LoanProposalRepository $loanProposal
     * @return bool
     * @throws \App\Exceptions\GeneralException
     */
    public function authorize(LoanProposalRepository $loanProposal)
    {
        if($this->user()->hasRole('admin')){
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'is_approved' => ['required','boolean'],
            'decline_reason' => ['required_if:is_approved,false,0','max:255']
        ];
    }
}
