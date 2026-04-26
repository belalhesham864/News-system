<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id'=>'required',
            'site_name' => 'required|string|max:30',

            'email' => 'required|email|max:50',

            'phone' => 'required|string|max:20',

            'country' => 'required|string|max:50',
            'city' => 'required|string|max:50',
            'street' => 'required|string|max:85',

            'facebook' => 'required|url|max:100',
            'tiwter' => 'required|url|max:100',
            'instgram' => 'required|url|max:100',
            'youtube' => 'required|url|max:100',

            'SmallDesc' => 'required|string|max:500',
            'contact' => 'required|string|max:2000',

            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'favicon' => 'nullable|image|mimes:jpg,jpeg,png,ico',
        ];
    }
}
