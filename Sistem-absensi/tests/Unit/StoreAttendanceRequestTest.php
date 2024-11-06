<?php

namespace Tests\Unit\Requests;

use Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreAttendanceRequest;
use App\Models\Student;

class StoreAttendanceRequestTest extends TestCase
{
    /**
     * Test bahwa 'name' wajib diisi.
     */
    public function test_name_is_required()
    {
        $data = [
            'name' => '',
            'class' => '10A',
            'date' => '2024-10-31',
            'status' => 'hadir',
        ];

        $request = new StoreAttendanceRequest();
        $validator = Validator::make($data, $request->rules(), $request->messages());

        $this->assertFalse($validator->passes());
        $this->assertEquals('Nama siswa harus diisi.', $validator->errors()->first('name'));
    }

    /**
     * Test bahwa 'class' wajib diisi.
     */
    public function test_class_is_required()
    {
        $data = [
            'name' => 'John Doe',
            'class' => '',
            'date' => '2024-10-31',
            'status' => 'hadir',
        ];

        $request = new StoreAttendanceRequest();
        $validator = Validator::make($data, $request->rules(), $request->messages());

        $this->assertFalse($validator->passes());
        $this->assertEquals('Kelas harus diisi.', $validator->errors()->first('class'));
    }

    /**
     * Test bahwa 'date' wajib diisi.
     */
    public function test_date_is_required()
    {
        $data = [
            'name' => 'John Doe',
            'class' => '10A',
            'date' => '',
            'status' => 'hadir',
        ];

        $request = new StoreAttendanceRequest();
        $validator = Validator::make($data, $request->rules(), $request->messages());

        $this->assertFalse($validator->passes());
        $this->assertEquals('Tanggal absen harus diisi.', $validator->errors()->first('date'));
    }

    /**
     * Test bahwa 'status' wajib diisi.
     */
    public function test_status_is_required()
    {
        $data = [
            'name' => 'John Doe',
            'class' => '10A',
            'date' => '2024-10-31',
            'status' => '',
        ];

        $request = new StoreAttendanceRequest();
        $validator = Validator::make($data, $request->rules(), $request->messages());

        $this->assertFalse($validator->passes());
        $this->assertEquals('Status absen harus diisi.', $validator->errors()->first('status'));
    }

    /**
     * Test bahwa 'status' hanya menerima nilai yang valid.
     */
    public function test_status_must_be_a_valid_enum()
    {
        $data = [
            'name' => 'John Doe',
            'class' => '10A',
            'date' => '2024-10-31',
            'status' => 'invalid_status',
        ];

        $request = new StoreAttendanceRequest();
        $validator = Validator::make($data, $request->rules(), $request->messages());

        $this->assertFalse($validator->passes());
        $this->assertEquals('Status absen harus salah satu dari: hadir, sakit, izin, alpha.', $validator->errors()->first('status'));
    }

    /**
     * Test bahwa 'date' harus berupa format tanggal yang valid.
     */
    public function test_date_must_be_a_valid_date()
    {
        $data = [
            'name' => 'John Doe',
            'class' => '10A',
            'date' => 'not_a_date',
            'status' => 'hadir',
        ];

        $request = new StoreAttendanceRequest();
        $validator = Validator::make($data, $request->rules(), $request->messages());

        $this->assertFalse($validator->passes());
        $this->assertEquals('Format tanggal absen tidak valid.', $validator->errors()->first('date'));
    }

    /**
     * Test bahwa 'name' dan 'class' harus sesuai dengan data di database.
     */
    public function test_name_and_class_combination_must_exist_in_student_database()
    {
        $data = [
            'name' => 'Nonexistent Student',
            'class' => '10A',
            'date' => '2024-10-31',
            'status' => 'hadir',
        ];

        $request = new StoreAttendanceRequest();
        $validator = Validator::make($data, $request->rules(), $request->messages());
        $request->withValidator($validator);

        $this->assertFalse($validator->passes());
        $this->assertEquals('Siswa dengan nama \'\' di kelas \'\' tidak ditemukan.', $validator->errors()->first('name'));
    }

    public function test_validation_passes_with_valid_data()
{
    // Arrange: Buat data siswa yang valid di database
    Student::factory()->create([
        'name' => 'John Doe',
        'class' => 'XII-A',
    ]);

    $data = [
        'name' => 'John Doe',
        'class' => 'XII-A',
        'date' => '2024-10-31',
        'status' => 'hadir',
    ];

    // Simulasikan request dengan data yang sesuai
    $request = new StoreAttendanceRequest();
    $request->merge($data); // Memasukkan data ke dalam request

    // Act: Buat validator menggunakan rules dan messages dari StoreAttendanceRequest
    $validator = Validator::make($request->all(), $request->rules(), $request->messages());
    $request->withValidator($validator);

    // Assert: Validasi harus berhasil tanpa error
    $this->assertTrue($validator->passes());
    $this->assertEmpty($validator->errors()->all());
}
    public function test_validation_passes_with_invalid_data()
{
    $data = [
        'name' => 'Invalid',  // Nilai yang akan kita cek
        'class' => 'XII-Z',   // Nilai kelas yang juga kita cek
        'date' => '2024-10-31',
        'status' => 'hadir',
    ];

    // Simulasikan request dengan data yang sesuai
    $request = new StoreAttendanceRequest();
    $request->merge($data); // Memasukkan data ke dalam request

    // Act: Buat validator menggunakan rules dan messages dari StoreAttendanceRequest
    $validator = Validator::make($request->all(), $request->rules(), $request->messages());
    $request->withValidator($validator);


    // Pesan error yang diharapkan menggunakan data dinamis
    $expectedError = "Siswa dengan nama '{$data['name']}' di kelas '{$data['class']}' tidak ditemukan.";

    // Assert: Validasi harus gagal dengan pesan error yang sesuai
    $this->assertFalse($validator->passes());
    $this->assertEquals($expectedError, $validator->errors()->first('name'));
}



}

