<?php

namespace App\Http\Controllers;

use App\Models\AssignmentStudent;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.score.index', [
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
    public function show(User $score): View
    {
        return view('admin.score.show', [
            'title' => 'Instructor Attendance',
            'assignments' => AssignmentStudent::where('student_id', $score->id)->get(),
            'studentAttendance' => $score,
        ]);
    }
}
