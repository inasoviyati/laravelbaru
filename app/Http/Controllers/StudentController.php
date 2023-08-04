<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('admin.student.index', [
            'students' => User::where('role', 'student')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.student.create');
    }

    public function store(Request $request)
    {
        $this->validation($request);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt(rand(11111111,99999999)),
            'role' => 'student'
        ]);

        return redirect()->route('student.index')
            ->with([
                'color' => 'success',
                'status' => 'Mahasiswa berhasil dtambahkan',
            ]);
    }

    public function show(User $student)
    {
        return view('admin.student.show', [
            'student' => $student
        ]);
    }

    public function edit(User $student)
    {
        return view('admin.student.edit', [
            'student' => $student
        ]);
    }

    public function update(Request $request, User $student)
    {
        $this->validation($request);

        User::find($student->id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('student.index')
            ->with([
                'color' => 'success',
                'status' => 'Mahasiswa berhasil diperbarui',
            ]);
    }

    public function destroy(User $student)
    {
        $student->delete();

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
