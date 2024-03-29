<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentStudent;
use App\Models\Facility;
use App\Models\Room;
use App\Models\Shift;
use App\Models\Subject;
use App\Models\User;
use App\Services\HasDate;
use DateTime;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    use HasDate;

    protected $title = 'Penugasan';

    public function index($facility = null)
    {
        $facility = Facility::find($facility);

        if (!$facility) {
            $facility = Facility::firstOrFail();
        }

        return view('admin.assignment.index', [
            'title' => $this->title,
            'assignments' => Assignment::with('subject', 'assignmentStudents')->where('facility_id', $facility->id)->get(),
            'shifts' => Shift::orderBy('time_start')->get(),
            'facility' => $facility,
            'facilities' => Facility::get(),
        ]);
    }

    public function create(Facility $facility, Shift $shift, $day)
    {
        $excludeInstructors = Assignment::where('shift_id', $shift->id)->where('day', $day)->pluck('instructor_id');

        return view('admin.assignment.create', [
            'title' => $this->title,
            'shift' => $shift,
            'day' => $day,
            'dayName' => $this->numberToDayName($day),
            'subjects' => Subject::orderBy('name')->get(),
            'instructors' => User::where('role', 'instructor')->whereNotIn('id', $excludeInstructors)->orderBy('name')->get(),
            'facility' => $facility
        ]);
    }

    public function store(Request $request, Facility $facility, Shift $shift, $day)
    {
        $request->merge([
            'shift' => $shift->id,
            'day' => $day,
            'facility' => $facility->id,
        ]);

        $request->validate([
            'facility' => 'required|exists:facilities,id',
            'instructor' => 'required|exists:users,id',
            'subject' => 'required|exists:subjects,id',
            'shift' => 'required|exists:shifts,id',
            'day' => 'required|digits_between:1,7',
        ]);

        $assignment = Assignment::create([
            'instructor_id' => $request->instructor,
            'subject_id' => $request->subject,
            'facility_id' => $facility->id,
            'shift_id' => $shift->id,
            'day' => $day,
        ]);

        $today = new DateTime();
        $dayNumber = $day;

        $daysOfWeek = [
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
            7 => 'Sunday'
        ];

        if ($today->format('N') != $dayNumber) {
            $today->modify('next ' . $daysOfWeek[$dayNumber]);
        }

        for ($i = 0; $i < 10; $i++) {
            $assignment->meets()->create([
                'date' => $today->format('Y-m-d')
            ]);

            $today->modify('+1 week');
        }

        return redirect()->route('assignment.edit', ['facility' => $facility, 'shift' => $shift->id, 'day' => $day, 'assignment' => $assignment->id])
            ->with([
                'color' => $colorAlert ?? 'success',
                'status' => "{$this->title} " . ($statusAlert ?? 'berhasil') . " ditambahkan",
            ]);
    }

    public function edit(Facility $facility, Shift $shift, $day, Assignment $assignment, Request $request)
    {
        $excludeInstructors = Assignment::where('shift_id', $shift->id)->where('day', $day)->pluck('instructor_id');
        $assignmentStundents = AssignmentStudent::where('assignment_id', $assignment->id)->get();

        return view('admin.assignment.edit', [
            'title' => $this->title,
            'shift' => $shift,
            'day' => $day,
            'facility' => $facility,
            'assignment' => $assignment,
            'dayName' => $this->numberToDayName($day),
            'rooms' => Room::orderBy('name')->get(),
            'students' => User::where('role', '!=', 'admin')->orWhere('role', null)->whereNotIn('id', $assignmentStundents->pluck('student_id'))->orderBy('name')->get(),
            'subjects' => Subject::orderBy('name')->get(),
            'instructors' => User::where('role', 'instructor')->whereNotIn('id', $excludeInstructors)->orderBy('name')->get(),
            'assignmentStudents' => $assignmentStundents,
        ]);
    }

    public function update(Request $request, Facility $facility, Shift $shift, $day, Assignment $assignment)
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
                'color' => $colorAlert ?? 'success',
                'status' => "{$this->title} " . ($statusAlert ?? 'berhasil') . " diperbarui",
            ]);
    }

    public function destroy(Facility $facility, Shift $shift, $day, Assignment $assignment)
    {
        $assignment->delete();

        return redirect()->route('assignment.index')
            ->with([
                'color' => $colorAlert ?? 'success',
                'status' => "{$this->title} " . ($statusAlert ?? 'berhasil') . " dihapus",
            ]);
    }
}
