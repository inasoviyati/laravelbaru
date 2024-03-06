<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Assistance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InstructorAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.instructorAttendance.index', [
            'title' => 'Instructor Attendance',
            'instructors' => User::where('role', 'instructor')->orderBy('name')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Assignment $assignment
     * @return View
     */
    public function show(User $instructorAttendance): View
    {
        return view('admin.instructorAttendance.show', [
            'title' => 'Instructor Attendance',
            'assignments' => Assignment::where('instructor_id', $instructorAttendance->id)->get(),
            'instructorAttendance' => $instructorAttendance,
        ]);
    }
}
