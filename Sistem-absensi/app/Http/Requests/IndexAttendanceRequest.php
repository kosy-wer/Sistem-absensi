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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'  => 'required|string|exists:students,nama',  // Validasi nama harus ada di tabel students
            'class' => 'required|string|exists:students,kelas', // Validasi kelas harus ada di tabel students
        ];
    }

    /**
     * Retrieve the data to be validated from the route parameters.
     */
    public function validationData()
    {
        return [
            'name'  => $this->route('name'),
            'class' => $this->route('class'),
        ];
    }
}

