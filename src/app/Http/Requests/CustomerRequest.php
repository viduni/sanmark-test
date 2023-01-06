<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'customer_account_number' => 'required|exists:App\Models\Customer,account_number|numeric',
        ];
    }

    public function messages()
    {
        return [
            'customer_account_number.required' => 'Account number is required!',
            'customer_account_number.exists' => 'This account is not existing',
            'customer_account_number.numeric' => 'Account number shuold be a number.',
        ];
    }
}
