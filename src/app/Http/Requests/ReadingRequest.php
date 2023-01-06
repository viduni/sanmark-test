<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ReadingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check(); 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'reading_date' => 'required|date',
            'reading_value' => 'required|numeric',
            'customer_account_number' => 'required|exists:App\Models\Customer,account_number|numeric',
        ];
    }

    public function messages()
    {
        return [
            'reading_date.required' => 'Reading date is required!',
            'reading_date.date' => 'Reading date should valid date',
            'reading_value.required' => 'Reading value is required!',
            'reading_value.numeric' => 'Reading value should be number',
            'customer_account_number.required' => 'Account number is required!',
            'customer_account_number.exists' => 'This account is not existing',
            'customer_account_number.numeric' => 'Account number shuold be a number.',
        ];
    }
}
