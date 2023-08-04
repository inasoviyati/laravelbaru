<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstructorAttendanceController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index');
    }
}
