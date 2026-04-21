<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        'name' => 'required|string|min:2',
        'username' => 'required|string|unique:users,username',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        'status' => 'in:0,1',
        'email_verified_at' => 'in:0,1',
        'country' => 'required|string|max:10',
        'city' => 'required|string|max:50',
        'street' => 'required|string|max:50',
        'password' => 'required|min:8|confirmed',
        'password_confirmation' => 'required|min:8',
    ];
    }
}
