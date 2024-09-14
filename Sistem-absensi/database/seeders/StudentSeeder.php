<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
    protected $model = Attendance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'student_id' => Student::factory(), // Menghasilkan student secara otomatis
            'tanggal_absen' => $this->faker->date(),
            'status_absen' => $this->faker->randomElement(['hadir', 'sakit', 'izin', 'alpha']),
        ];
    }
}

