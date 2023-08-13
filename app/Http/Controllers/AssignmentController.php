<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    protected $title = 'Penugasan';

    public function index()
    {
        return view('admin.assignment.index', [
            'title' => $this->title,
            'assignments' => Assignment::get(),
            'shifts' => Shift::orderBy('time_start')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.assignment.create', [
            'title' => $this->title,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        Assignment::create([
            'name' => $request->name,
        ]);

        return redirect()->route('assignment.index')
            ->with([
                'color' => 'success',
                'status' => "{$this->title} berhasil dtambahkan",
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

    public function edit(Assignment $assignment)
    {
        return view('admin.assignment.edit', [
            'title' => $this->title,
            'assignment' => $assignment
        ]);
    }

    public function update(Request $request, Assignment $assignment)
    {
        Assignment::find($assignment->id)->update([
            'name' => $request->name,
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
}
