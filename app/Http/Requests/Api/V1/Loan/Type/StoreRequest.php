<?php

namespace App\Http\Requests\Api\V1\Loan\Type;

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
            'name' => ['required','max:255'],
            'interest_type' => ['required','in:Fixed Monthly Amount'],
            'interest_rate' => ['required','numeric','min:0']
        ];
    }


    public function messages()
    {
        return [
            'interest_type.in' => "Interest type must be among [Fixed Monthly Amount,Fixed Monthly Percentage,Fixed Yearly Amount,Fixed Yearly Percentage]"
        ];
    }
}
