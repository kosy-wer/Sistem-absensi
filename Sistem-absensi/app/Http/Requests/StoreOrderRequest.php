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
        return [
            'keterangan' => 'required|in:masuk,sakit,absen',
            'alasan' => 'nullable|string|max:255',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $keterangan = $this->input('keterangan');
            $alasan = $this->input('alasan');

            if ($keterangan !== 'absen' && !is_null($alasan)) {
                $validator->errors()->add('alasan', 'Alasan hanya bisa di isi jika keterangan absen.');
            }

            if ($keterangan === 'absen' && is_null($alasan)) {
                $validator->errors()->add('alasan', 'Jika keterangan absen maka harus mengisi alasan.');
            }
        });
    }

    public function messages()
    {
        return [
            'keterangan.required' => 'Status is required.',
            'keterangan.in' => 'Status must be one of the following: masuk, izin, absen.',
            'alasan.string' => 'Reason must be a string.',
            'alasan.max' => 'Reason may not be greater than 255 characters.',
        ];
    }
}

