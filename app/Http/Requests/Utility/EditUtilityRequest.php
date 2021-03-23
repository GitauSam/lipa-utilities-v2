<?php

namespace App\Http\Requests\Utility;

use Illuminate\Foundation\Http\FormRequest;

class EditUtilityRequest extends FormRequest
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
            'utility_name' => 'required|string|max:255',
            'utility_payment_methods' => 'required|array|min:1',
            'utility_payment_methods.*' => 'required|string|distinct'
        ];
        
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'utility_name' => 'Please provide a valid utility name!',
            'utility_payment_methods' => 'At least one valid payment method should be specified!',
        ];
    }
}
