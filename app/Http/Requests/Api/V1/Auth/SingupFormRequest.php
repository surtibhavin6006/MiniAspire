<?php

namespace App\Http\Requests\Api\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SingupFormRequest extends FormRequest
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
        return [
            'first_name' => ['required','alpha','max:255'],
            'last_name' => ['required','alpha','max:255'],
            'email' => ['required','unique:users,email','email'],
            'password' => ['required','alpha_num','max:255'],
            'address1' => ['required','max:255'],
            'zipcode' => ['required','numeric'],
            'mobile_number' => ['required','max:255'],
            'gender' => ['required',Rule::in(['Male','Female','Other'])]
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
          'gender.in' => "Please select Gender from ['Male','Female','Other']"
        ];
    }
}
