<?php

namespace Database\Factories;

use App\Models\Attendance;
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
            'student_id' => $this->faker->numberBetween(1, 100), // ID siswa acak antara 1-100
            'tanggal_absen' => $this->faker->dateTimeThisYear(), // Tanggal acak di tahun ini
            'status_absen' => $this->faker->randomElement(['hadir', 'alpha', 'izin', 'sakit']), // Status acak
        ];
    }
}

