<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Attendance;
use App\Http\Resources\AttendanceResource;

class AttendanceController extends Controller
{
    /**
     * Store a newly created attendance in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi request
        $validatedData = $request->validate([
            'student_id' => 'required|exists:students,id',
            'tanggal_absen' => 'required|date',
            'status_absen' => 'required|in:hadir,sakit,izin,alpha',
        ]);

        // Simpan attendance ke database
        $attendance = Attendance::create([
            'student_id' => $validatedData['student_id'],
            'tanggal_absen' => $validatedData['tanggal_absen'],
            'status_absen' => $validatedData['status_absen'],
        ]);


        return new AttendanceResource($attendance);


    }
}

