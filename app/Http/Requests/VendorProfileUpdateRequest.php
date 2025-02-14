<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Vendor;
use Illuminate\Validation\Rule;

class VendorProfileUpdateRequest extends FormRequest
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
            'phone' => ['string', 'min:9', 'max:14', Rule::unique(Vendor::class)->ignore($this->user()->id)],
            'vendor_name' => ['string', 'max:255', Rule::unique(Vendor::class)->ignore($this->user()->id)],
            'avatar' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'], // Max file size is set to 2MB (2048KB)
            'cover_photo' => [ 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'dial_code' => ['string'],
            'whatsapp_number' => ['numeric', 'digits_between:9,14'],

            // For chefs table
            'profession' => ['string', 'max:100'],
            'facebook_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'instagram_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'youtube_link' => 'nullable|url',
            'description' => 'nullable|string|max:5000',
        ];
    }
}
