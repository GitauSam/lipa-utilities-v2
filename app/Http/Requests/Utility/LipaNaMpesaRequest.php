<?php

namespace App\Http\Requests\Utility;

use Illuminate\Foundation\Http\FormRequest;

class LipaNaMpesaRequest extends FormRequest
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
            'amount' => ['required', 'string', 'min:1'],
            'acc_ref' => ['required', 'string', 'min:1'],
            'pbno' => ['required', 'string', 'min:1'],
            'utility_id' => ['required', 'string', 'min:1'],
        ];
    }

    public function messages()
    {
        return [
            'amount.*' => 'Please enter a valid amount.' ,
            'acc_ref.*' => 'Please enter a valid account number.',
            'pbno.*' => 'Please enter a valid paybill number.',
            'utility_id.*' => 'Please provide a valid utility.',
        ];
    }
}
