<?php

namespace App\Http\Requests\Api\V1\Loan\Emi;

use App\Repository\loan\Emi\LoanEmiRepository;
use Illuminate\Foundation\Http\FormRequest;

class ViewRequest extends FormRequest
{
    /**
     * @param LoanEmiRepository $loanEmi
     * @return bool
     * @throws \App\Exceptions\GeneralException
     */
    public function authorize(LoanEmiRepository $loanEmi)
    {
        $requestId = request('id');

        $loanEmi = $loanEmi->find($requestId);

        if($this->user()->hasRole('admin')){
            return true;
        } else {

            if(!empty($loanEmi) && $loanEmi->user_id == $this->user()->id){
                return true;
            }
        }
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
