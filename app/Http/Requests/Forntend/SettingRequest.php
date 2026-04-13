<?php

namespace App\Http\Requests\Forntend;

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
            'name'=>'required|string|max:20|min:2',
            'username'=>'required|string|unique:users,username,'.auth()->user()->id,
            'email'=>'required|email|unique:users,email,'.auth()->user()->id,
            'phone'=>'required|numeric|unique:users,phone,'.auth()->user()->id,
            'country'=>'required|min:3|max:10',
            'city'=>'required|min:3|max:20',
            'street'=>'required|min:3|max:40',
            'image'=>'nullable|image|mimes:jpg,jpeg,png,webp'
        ];
    }
}
