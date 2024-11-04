<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\IndexAttendanceRequest;
use App\Models\Attendance;
use App\Models\Student;
use App\Http\Resources\AttendanceResource;

class AttendanceController extends Controller
{
    public function store(StoreAttendanceRequest $request)
    {
        $student = Student::where('name', $request->name)
                          ->where('class', $request->class)
                          ->first();

        // Simpan attendance ke database
        $attendance = Attendance::create([
            'student_id' => $student->id,
            'date' => $request->date,
            'status' => $request->status,
        ]);

        return new AttendanceResource($attendance);
    }


    public function index(IndexAttendanceRequest $request)
{
    $student = Student::where('name', $request->name)
                      ->where('class', $request->class)
                      ->first();

    if (!$student) {
        return response()->json(['message' => 'Student not found'], 404);
    }

    // Ambil data absensi berdasarkan student_id
    $attendance = Attendance::where('student_id', $student->id)->get();

    return AttendanceResource::collection($attendance);
 }


    public function show()
 {
    // Ambil semua data absensi
    $attendance = Attendance::all();

    return AttendanceResource::collection($attendance);
 }


}

