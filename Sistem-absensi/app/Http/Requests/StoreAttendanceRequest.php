<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Student;

class StoreAttendanceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'class' => 'required|string',
            'date' => 'required|date',
            'status' => 'required|in:hadir,sakit,izin,alpha',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama siswa harus diisi.',
            'class.required' => 'Kelas harus diisi.',
            'date.required' => 'Tanggal absen harus diisi.',
            'date.date' => 'Format tanggal absen tidak valid.',
            'status.required' => 'Status absen harus diisi.',
            'status.in' => 'Status absen harus salah satu dari: hadir, sakit, izin, alpha.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $student = Student::where('name', $this->name)
                              ->where('class', $this->class)
                              ->first();

            if (!$student) {
                $validator->errors()->add('name', 'Siswa tidak ditemukan di kelas ini.');
            }
        });
    }
}

