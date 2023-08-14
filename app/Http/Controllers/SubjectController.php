<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    protected $title = 'Data Mata Kuliah';

    public function index()
    {
        return view('admin.subject.index', [
            'title' => $this->title,
            'rooms' => Subject::orderBy('name')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.subject.create', [
            'title' => $this->title,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        Subject::create([
            'name' => $request->name,
        ]);

        return redirect()->route('subject.index')
            ->with([
                'color' => 'success',
                'status' => "{$this->title} berhasil ditambahkan",
            ]);
    }

    public function show(Subject $subject)
    {
        return view('admin.subject.show', [
            'title' => $this->title,
            'subject' => $subject,
            'students' => User::where('role', '!=', 'admin')->where(function ($query) use ($subject) {
                $query->select('room_id')
                    ->from('room_users')
                    ->whereColumn('room_users.student_id', 'users.id')
                    ->limit(1);
            }, $subject->id)->orderBy('name')->get()
        ]);
    }

    public function edit(Subject $subject)
    {
        return view('admin.subject.edit', [
            'title' => $this->title,
            'subject' => $subject
        ]);
    }

    public function update(Request $request, Subject $subject)
    {
        Subject::find($subject->id)->update([
            'name' => $request->name,
        ]);

        return redirect()->route('subject.index')
            ->with([
                'color' => 'success',
                'status' => "{$this->title} berhasil diperbarui",
            ]);
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->back()
            ->with([
                'color' => 'success',
                'status' => "{$this->title} berhasil dihapus",
            ]);
    }
}
