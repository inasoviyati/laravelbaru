<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    protected $title = 'Instruktur';

    public function index()
    {
        return view('admin.instructor.index', [
            'title' => $this->title,
            'instructors' => User::where('role', '!=', null)->get(),
        ]);
    }

    public function create()
    {
        return view('admin.instructor.create', [
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
            'role' => 'instructor'
        ]);

        $user->roomUser()->create([
            'student_id' => $user->id,
            'room_id' => $request->room
        ]);

        return redirect()->route('instructor.index')
            ->with([
                'color' => 'success',
                'status' => "{$this->title} berhasil ditambahkan",
            ]);
    }

    public function show(User $instructor)
    {
        return view('admin.instructor.show', [
            'title' => $this->title,
            'instructor' => $instructor,
            'rooms' => Room::orderBy('name')->get()
        ]);
    }

    public function edit(User $instructor)
    {
        return view('admin.instructor.edit', [
            'title' => $this->title,
            'instructor' => $instructor,
            'rooms' => Room::orderBy('name')->get()
        ]);
    }

    public function update(Request $request, User $instructor)
    {
        $this->validation($request, $instructor->npm);

        $instructor->update([
            'name' => $request->name,
            'email' => $request->email,
            'npm' => $request->npm,
        ]);

        $instructor->roomUser()->update([
            'room_id' => $request->room
        ]);

        if ($request->password) {
            $instructor->update([
                'password' => bcrypt($request->password)
            ]);
        }

        return redirect()->route('instructor.index')
            ->with([
                'color' => 'success',
                'status' => "{$this->title} berhasil diperbarui",
            ]);
    }

    public function destroy(User $instructor)
    {
        $instructor->update([
            'role' => null
        ]);

        return redirect()->back()
            ->with([
                'color' => 'success',
                'status' => "{$this->title} berhasil dihapus",
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
