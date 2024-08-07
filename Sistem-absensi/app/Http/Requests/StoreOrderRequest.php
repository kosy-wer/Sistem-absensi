<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'status' => 'required|in:value1,value2,value3',
            'reason' => 'nullable|string|max:255',
        ];

        if ($this->input('status') === 'value1') {
            $rules['reason'] = 'required|string|max:255';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'status.required' => 'Status is required.',
            'status.in' => 'Status must be one of the following: value1, value2, value3.',
            'reason.required' => 'Reason is required when status is value1.',
        ];
    }
}

