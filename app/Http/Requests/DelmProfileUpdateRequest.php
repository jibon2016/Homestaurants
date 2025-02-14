<?php

namespace App\Http\Requests;

use App\Models\DeliveryMan;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DelmProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'phone' => ['string', 'min:9', 'max:14', Rule::unique(DeliveryMan::class)->ignore($this->user()->id)],
            'avatar' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'], // Max file size is set to 2MB (2048KB)
            'dial_code' => ['string'],
            'whatsapp_number' => ['numeric', 'digits_between:9,14'],
        ];
    }
}
