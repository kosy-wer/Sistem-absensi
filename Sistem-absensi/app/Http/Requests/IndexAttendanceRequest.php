<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexAttendanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Set to true jika tidak ada otorisasi khusus
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'student_name' => 'required|string|exists:students,nama', // Validasi nama harus ada di tabel students
            'kelas'        => 'required|string|exists:students,kelas', // Validasi kelas harus ada di tabel students
        ];
    }
}

