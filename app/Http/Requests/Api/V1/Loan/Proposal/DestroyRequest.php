<?php

namespace App\Http\Requests\Api\V1\Loan\Proposal;

use App\Repository\loan\Proposal\LoanProposalRepository;
use Illuminate\Foundation\Http\FormRequest;

class DestroyRequest extends FormRequest
{
    /**
     * @param LoanProposalRepository $loanProposal
     * @return bool
     * @throws \App\Exceptions\GeneralException
     */
    public function authorize(LoanProposalRepository $loanProposal)
    {
        $requestId = request('id');

        $loanProposalData = $loanProposal->find($requestId);

        if($this->user()->hasRole('admin')){

            if(!empty($loanProposalData) && !$loanProposalData->is_approved){
                return true;
            }

        } else {

            if(!empty($loanProposalData) && $loanProposalData->user_id == $this->user()->id){
                return true;
            }
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
            //
        ];
    }
}
