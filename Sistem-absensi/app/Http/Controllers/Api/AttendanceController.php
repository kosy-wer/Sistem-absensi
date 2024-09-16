<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAttendanceRequest;
use App\Models\Attendance;
use App\Models\Student;
use App\Http\Resources\AttendanceResource;

class AttendanceController extends Controller
{
    public function store(StoreAttendanceRequest $request)
    {
        // Cari student berdasarkan nama dan kelas
        $student = Student::where('nama', $request->student_name)
                          ->where('kelas', $request->kelas)
                          ->first();

        // Simpan attendance ke database
        $attendance = Attendance::create([
            'student_id' => $student->id,
            'tanggal_absen' => $request->tanggal_absen,
            'status_absen' => $request->status_absen,
        ]);

        return new AttendanceResource($attendance);
    }
}

