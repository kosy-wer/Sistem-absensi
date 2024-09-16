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
            'student_name' => 'required|string',
            'kelas' => 'required|string',
            'tanggal_absen' => 'required|date',
            'status_absen' => 'required|in:hadir,sakit,izin,alpha',
        ];
    }

    public function messages()
    {
        return [
            'student_name.required' => 'Nama siswa harus diisi.',
            'kelas.required' => 'Kelas harus diisi.',
            'tanggal_absen.required' => 'Tanggal absen harus diisi.',
            'tanggal_absen.date' => 'Format tanggal absen tidak valid.',
            'status_absen.required' => 'Status absen harus diisi.',
            'status_absen.in' => 'Status absen harus salah satu dari: hadir, sakit, izin, alpha.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $student = Student::where('nama', $this->student_name)
                              ->where('kelas', $this->kelas)
                              ->first();

            if (!$student) {
                $validator->errors()->add('student_name', 'Siswa tidak ditemukan di kelas ini.');
            }
        });
    }
}

