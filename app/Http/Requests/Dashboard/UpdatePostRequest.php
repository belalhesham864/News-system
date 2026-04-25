<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'title'=>'required|min:5|string',
            'SmallDesc'=>'required|min:10|string|max:50',
            'desc'=>'required|min:20|string',
            'category_id'=>'required|exists:categories,id',
            'comment_able'=>'nullable',
            'status'=>'required|in:1,0',
            'images'=>'nullable|array',
            'images.*'=>'image|mimes:jpg,jpeg,png,webp'
        ];
    }
    public function attributes()
    {
        return[

            'category_id'=>'Category Name',
            ];
    }
}
