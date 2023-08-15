<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Shift;
use App\Models\Subject;
use App\Models\User;
use App\Services\HasDate;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    use HasDate;

    protected $title = 'Penugasan';

    public function index()
    {
        return view('admin.assignment.index', [
            'title' => $this->title,
            'assignments' => Assignment::with('subject')->get(),
            'shifts' => Shift::orderBy('time_start')->get(),
        ]);
    }

    public function create(Shift $shift, $day)
    {
        return view('admin.assignment.create', [
            'title' => $this->title,
            'shift' => $shift,
            'day' => $day,
            'dayName' => $this->numberToDayName($day),
            'subjects' => Subject::orderBy('name')->get(),
            'instructors' => User::where('role', 'instructor')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request, Shift $shift, $day)
    {
        $request->merge([
            'shift' => $shift->id,
            'day' => $day,
        ]);

        $request->validate([
            'instructor' => 'required|exists:users,id',
            'subject' => 'required|exists:subjects,id',
            'shift' => 'required|exists:shifts,id',
            'day' => 'required|digits_between:1,7',
        ]);

        Assignment::create([
            'instructor_id' => $request->instructor,
            'subject_id' => $request->subject,
            'shift_id' => $shift->id,
            'day' => $day,
        ]);

        return redirect()->route('assignment.index')
            ->with([
                'color' => 'success',
                'status' => "{$this->title} berhasil ditambahkan",
            ]);
    }

    public function show(Assignment $assignment)
    {
        return view('admin.assignment.show', [
            'title' => $this->title,
            'assignment' => $assignment,
            'students' => User::where('role', '!=', 'admin')->where(function ($query) use ($assignment) {
                $query->select('assignment_id')
                    ->from('assignment_users')
                    ->whereColumn('assignment_users.student_id', 'users.id')
                    ->limit(1);
            }, $assignment->id)->get()
        ]);
    }

    public function edit(Shift $shift, $day, Assignment $assignment, Request $request)
    {
        return view('admin.assignment.edit', [
            'title' => $this->title,
            'shift' => $shift,
            'day' => $day,
            'assignment' => $assignment,
            'dayName' => $this->numberToDayName($day),
            'subjects' => Subject::orderBy('name')->get(),
            'instructors' => User::where('role', 'instructor')->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Shift $shift, $day, Assignment $assignment)
    {
        $request->merge([
            'shift' => $shift->id,
            'day' => $day,
        ]);

        $request->validate([
            'instructor' => 'required|exists:users,id',
            'subject' => 'required|exists:subjects,id',
            'shift' => 'required|exists:shifts,id',
            'day' => 'required|digits_between:1,7',
        ]);

        $assignment->update([
            'instructor_id' => $request->instructor,
            'subject_id' => $request->subject,
            'shift_id' => $shift->id,
            'day' => $day,
        ]);

        return redirect()->route('assignment.index')
            ->with([
                'color' => 'success',
                'status' => "{$this->title} berhasil diperbarui",
            ]);
    }

    public function destroy(Assignment $assignment)
    {
        $assignment->delete();

        return redirect()->back()
            ->with([
                'color' => 'success',
                'status' => "{$this->title} berhasil dihapus",
            ]);
    }

    public function createWithDay(Shift $shift, $day)
    {
        return $day;
    }
}
