<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentStudent;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.studentAttendance.index', [
            'title' => 'Instructor Attendance',
            'instructors' => User::whereNull('role')->orderBy('name')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Assignment $assignment
     * @return View
     */
    public function show(User $studentAttendance): View
    {
        return view('admin.studentAttendance.show', [
            'title' => 'Instructor Attendance',
            'assignments' => AssignmentStudent::where('student_id', $studentAttendance->id)->get(),
            'studentAttendance' => $studentAttendance,
        ]);
    }
}
