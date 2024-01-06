<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentStudent;
use Illuminate\Http\Request;
use Throwable;

class AssignmentStudentController extends Controller
{
    protected $title = 'Daftar Mahasiswa';

    public function index()
    {
        //
    }

    public function store(Request $request, Assignment $assignment)
    {
        try {
            foreach ($request->users as $users_id) {
                AssignmentStudent::create([
                    'assignment_id' => $assignment->id,
                    'student_id' => $users_id
                ]);
            }
        } catch (Throwable $th) {
            $colorAlert = 'danger';
            $statusAlert = 'gagal';
        }

        return redirect()->route('assignment.edit', [
            'shift' => $assignment->shift_id,
            'day' => $assignment->day,
            'assignment' => $assignment->id,
            'facility' => $assignment->facility_id
        ])
            ->with([
                'color' => $colorAlert ?? 'success',
                'status' => "{$this->title} " . ($statusAlert ?? 'berhasil') . " ditambahkan",
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
                'color' => $colorAlert ?? 'success',
                'status' => "{$this->title} " . ($statusAlert ?? 'berhasil') . " dihapus",
            ]);
    }
}
