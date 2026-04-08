<?php

namespace App\Http\Requests\Forntend;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name'=>'required|string|min:2|max:30',
            'email'=>'required|email',
            'title'=>'required|string|max:50',
            'body'=>'required|min:10|max:500',
            'phone'=>'required|numeric'
        ];
    }
}
