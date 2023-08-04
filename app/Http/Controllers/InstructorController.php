<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\User;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function index()
    {
        return view('admin.instructor.index', [
            'instructors' => User::where('role', 'instructor')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.instructor.create');
    }

    public function store(Request $request)
    {
        $this->validation($request);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt(rand(11111111,99999999)),
            'role' => 'instructor'
        ]);

        return redirect()->route('instructor.index')
            ->with([
                'color' => 'success',
                'status' => 'Mahasiswa berhasil dtambahkan',
            ]);
    }

    public function show(User $instructor)
    {
        return view('admin.instructor.show', [
            'instructor' => $instructor
        ]);
    }

    public function edit(User $instructor)
    {
        return view('admin.instructor.edit', [
            'instructor' => $instructor
        ]);
    }

    public function update(Request $request, User $instructor)
    {
        $this->validation($request);

        User::find($instructor->id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('instructor.index')
            ->with([
                'color' => 'success',
                'status' => 'Mahasiswa berhasil diperbarui',
            ]);
    }

    public function destroy(User $instructor)
    {
        $instructor->delete();

        return redirect()->back()
            ->with([
                'color' => 'success',
                'status' => 'Mahasiswa berhasil dihapus',
            ]);
    }
    
    public function validation($request){
        return $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);
    }
}
