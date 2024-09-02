<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowOrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'Name must be a string.',
            'name.max' => 'Name may not be greater than 255 characters.',
        ];
    }
}

