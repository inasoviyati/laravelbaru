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

    public function destroy(User $instructor)
    {
        $instructor->update([
            'role' => null
        ]);

        return redirect()->back()
            ->with([
                'color' => $colorAlert ?? 'success',
                'status' => "{$this->title} " . ($statusAlert ?? 'berhasil') . " dihapus",
            ]);
    }
}
