<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $title = 'Mahasiswa';

    protected User $student;

    public function index()
    {
        return view('admin.student.index', [
            'title' => $this->title,
            'students' => User::where('role', '!=', 'admin')->orWhere('role', null)->get(),
        ]);
    }

    public function create()
    {
        return view('admin.student.create', [
            'title' => $this->title,
            'rooms' => Room::orderBy('name')->get()
        ]);
    }

    public function store(Request $request)
    {
        $this->validation($request);

        if (!$request->password || $request->password == null) {
            $request->merge(['password' => bcrypt(rand(11111111, 99999999))]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'npm' => $request->npm,
            'password' => $request->password,
            'role' => null
        ]);

        $user->roomUser()->create([
            'student_id' => $user->id,
            'room_id' => $request->room
        ]);

        return redirect()->route('student.index')
            ->with([
                'color' => $colorAlert ?? 'success',
                'status' => "{$this->title} " . ($statusAlert ?? 'berhasil') . " ditambahkan",
            ]);
    }

    public function show(User $student)
    {

        return view('admin.student.show', [
            'title' => $this->title,
            'student' => $student,
            'rooms' => Room::orderBy('name')->get()
        ]);
    }

    public function edit(User $student)
    {
        return view('admin.student.edit', [
            'title' => $this->title,
            'student' => $student,
            'rooms' => Room::orderBy('name')->get()
        ]);
    }

    public function update(Request $request, User $student)
    {
        $this->validation($request, $student->npm);

        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'npm' => $request->npm,
        ]);

        $isInstructor = $request->is_instructor;

        if ($isInstructor) {
            $student->update(['role' => 'instructor']);
        } else {
            $student->update(['role' => null]);
        }

        $student->roomUser()->update([
            'room_id' => $request->room
        ]);

        if ($request->password) {
            $student->update([
                'password' => bcrypt($request->password)
            ]);
        }

        return redirect()->route('student.index')
            ->with([
                'color' => $colorAlert ?? 'success',
                'status' => "{$this->title} " . ($statusAlert ?? 'berhasil') . " diperbarui",
            ]);
    }

    public function destroy(User $student)
    {
        $student->delete();

        return redirect()->back()
            ->with([
                'color' => $colorAlert ?? 'success',
                'status' => "{$this->title} " . ($statusAlert ?? 'berhasil') . " dihapus",
            ]);
    }

    public function validation($request, $npm = null)
    {
        $validated = $request->validate([
            'npm' => 'required|digits:8|unique:users,npm,' . $npm . ',npm',
            'name' => 'required|string|between:2,100',
            'room' => 'required|exists:rooms,id',
            'email' => 'required|email:rfc,dns',
            'password' => 'sometimes|nullable|between:8,50',
        ]);

        return $validated;
    }
}
