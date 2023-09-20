<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentStudent;
use Illuminate\Http\Request;
use Throwable;

class AssignmentStudentController extends Controller
{
    protected $title = 'Daftar Mahasiswa';

    public function index(AssignmentStudent $assignment_students)
    {
        $collection = [
            ['icon' => 'calendar', 'title' => 'Jadwal', 'slug' => 'calendar', 'image' => 357],
            ['icon' => 'clipboard', 'title' => 'Tugas', 'slug' => 'modules', 'image' => 4],
            ['icon' => 'edit', 'title' => 'Nilai', 'slug' => 'score', 'image' => 7],
            ['icon' => 'book', 'title' => 'BAP', 'slug' => 'bap', 'image' => 24],
        ];

        return view('instructor.menu.index', [
            'title' => 'Menu',
            'assignment_students' => $assignment_students,
            'collection' => $collection,
        ]);
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
