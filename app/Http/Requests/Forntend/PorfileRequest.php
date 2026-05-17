<?php

namespace App\Http\Requests\Forntend;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PorfileRequest extends FormRequest
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
        if($this->isMethod('PUT')){

            return [
                'title'=>'sometimes|string|min:3|max:50',
                'desc'=> 'sometimes|string|min:50',
                'status'=>'sometimes',
                'comment_able'=>'sometimes',
                'category_id'=>'sometimes|exists:categories,id',
                'images'=>'sometimes',
                'images.*'=> 'image','mimes:jpg,jpeg,png,webp',
                'SmallDesc'=>'sometimes|max:150|min:50'
                ];
                }
                     return [
                'title'=>'required|string|min:3|max:50',
                'desc'=> 'required|string|min:50',
                'category_id'=>'required|exists:categories,id',
                'images'=>'nullable',
                'images.*'=> 'image','mimes:jpg,jpeg,png,webp',
                'SmallDesc'=>'required|max:150|min:50'
                ];

    }
 
    public function attributes()
    {
        return [
            'title'=> 'post title'
        ];
    }
}
