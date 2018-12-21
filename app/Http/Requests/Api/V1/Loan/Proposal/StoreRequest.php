<?php

namespace App\Http\Requests\Api\V1\Loan\Proposal;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validation = [
            'reason' => ['required','max:255'],
            'borrow_amount' => ['required','numeric','min:0'],
            'loan_type_id' => ['required'],
            'tenure' => ['required','numeric','min:0'],
        ];

        if($this->user()->hasRole('admin')){
            $validation['client_id'] = ['required'];
        }

        return $validation;
    }
}
