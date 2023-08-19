<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentStudent;
use Illuminate\Http\Request;

class AssignmentStudentController extends Controller
{
    protected $title = 'Daftar Mahasiswa';

    public function store(Request $request, Assignment $assignment)
    {
        foreach ($request->users as $users_id) {
            AssignmentStudent::create([
                'assignment_id' => $assignment->id,
                'student_id' => $users_id
            ]);
        }

        return redirect()->route('assignment.edit', [
            'shift' => $assignment->shift_id,
            'day' => $assignment->day,
            'assignment' => $assignment->id
        ])
            ->with([
                'color' => 'success',
                'status' => "{$this->title} berhasil ditambahkan",
            ]);
    }

    public function show(AssignmentStudent $assignmentStudent)
    {
        //
    }

    public function destroy(Assignment $assignment, AssignmentStudent $assignmentStudent)
    {
        $assignmentStudent->delete();

        return redirect()->route('assignment.edit', [
            'shift' => $assignment->shift_id,
            'day' => $assignment->day,
            'assignment' => $assignment->id
        ])
            ->with([
                'color' => 'success',
                'status' => "{$this->title} berhasil dihapus",
            ]);
    }
}
