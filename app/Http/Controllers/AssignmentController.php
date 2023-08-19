<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentStudent;
use App\Models\Room;
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
        $excludeInstructors = Assignment::where('shift_id', $shift->id)->pluck('instructor_id');

        return view('admin.assignment.create', [
            'title' => $this->title,
            'shift' => $shift,
            'day' => $day,
            'dayName' => $this->numberToDayName($day),
            'subjects' => Subject::orderBy('name')->get(),
            'instructors' => User::where('role', 'instructor')->whereNotIn('id', $excludeInstructors)->orderBy('name')->get(),
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

    public function edit(Shift $shift, $day, Assignment $assignment, Request $request)
    {
        $excludeInstructors = Assignment::where('shift_id', $shift->id)->where('instructor_id', '!=', $assignment->instructor_id)->pluck('instructor_id');
        $assignmentStundents = AssignmentStudent::where('assignment_id', $assignment->id)->get();

        return view('admin.assignment.edit', [
            'title' => $this->title,
            'shift' => $shift,
            'day' => $day,
            'assignment' => $assignment,
            'dayName' => $this->numberToDayName($day),
            'rooms' => Room::orderBy('name')->get(),
            'students' => User::where('role', '!=', 'admin')->orWhere('role', null)->whereNotIn('id', $assignmentStundents->pluck('student_id'))->orderBy('name')->get(),
            'subjects' => Subject::orderBy('name')->get(),
            'instructors' => User::where('role', 'instructor')->whereNotIn('id', $excludeInstructors)->orderBy('name')->get(),
            'assignmentStudents' => $assignmentStundents,
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

    public function destroy(Shift $shift, $day, Assignment $assignment)
    {
        $assignment->delete();

        return redirect()->route('assignment.index')
            ->with([
                'color' => 'success',
                'status' => "{$this->title} berhasil dihapus",
            ]);
    }
}
