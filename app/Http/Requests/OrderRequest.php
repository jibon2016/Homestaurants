<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //return false;
        return true; // I was getting 403 unauthorized error for this
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|numeric|min:9|max:14',
            'delivery_address' => 'nullable|string|max:255',
            //'delivery_option' => 'required|in:delivery,pickup',
            'delivery_option' => 'required|boolean',
            'expected_receive_time' => 'required',
            'payment_method' => 'required',
        ];
    }
}
