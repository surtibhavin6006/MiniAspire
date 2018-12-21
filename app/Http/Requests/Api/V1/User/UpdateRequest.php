<?php

namespace App\Http\Requests\Api\V1\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'first_name' => ['sometimes','required','alpha','max:255'],
            'last_name' => ['sometimes','required','alpha','max:255'],
            'address1' => ['sometimes','required','max:255'],
            'zipcode' => ['sometimes','required','numeric']
        ];
    }
}
