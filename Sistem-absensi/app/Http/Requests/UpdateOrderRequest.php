<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
 {
    public function authorize()
    {
        return true;
   }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'status' => 'required|in:value1,value2,value3',
            'reason' => 'nullable|string|max:255',
        ];
    }

    public function withValidator($validator)
    {
    $validator->after(function ($validator) {
            $status = $this->input('status');
            $reason = $this->input('reason');

            if ($status !== 'value1' && !is_null($reason)) {
$validator->errors()->add('reason', 'Reason can only be filled when status is value1.');
            }

            if ($status === 'value1' && is_null($reason)) {
                $validator->errors()->add('reason', 'Reason is required when status is value1.');
            }
        });
    }
    public function messages()
    {
        return [
            'name.required' => 'Name is required.',
            'name.max' => 'Name may not be greater than 255 characters.',
            'status.required' => 'Status is required.',
            'status.in' => 'Status must be one of the following: value1, value2, value3.',
            'reason.string' => 'Reason must be a string.',
            'reason.max' => 'Reason may not be greater than 255 characters.',
        ];
    }
}
