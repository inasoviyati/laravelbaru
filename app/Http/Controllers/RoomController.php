<?php

namespace App\Http\Controllers;

use App\Models\AssignmentStudent;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    protected $title = 'Data Kelas';

    public function index()
    {
        return view('admin.room.index', [
            'title' => $this->title,
            'rooms' => Room::orderBy('name')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.room.create', [
            'title' => $this->title,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        Room::create([
            'name' => $request->name,
        ]);

        return redirect()->route('room.index')
            ->with([
                'color' => $colorAlert ?? 'success',
                'status' => "{$this->title} " . ($statusAlert ?? 'berhasil') . " ditambahkan",
            ]);
    }

    public function show(Room $room)
    {
        return view('admin.room.show', [
            'title' => $this->title,
            'room' => $room,
            'students' => User::whereHas('roomUsers', function ($q) use ($room) {
                $q->where('room_id', $room->id);
            })->orderBy('name')->get()
        ]);
    }

    public function edit(Room $room)
    {
        return view('admin.room.edit', [
            'title' => $this->title,
            'room' => $room
        ]);
    }

    public function update(Request $request, Room $room)
    {
        Room::find($room->id)->update([
            'name' => $request->name,
        ]);

        return redirect()->route('room.index')
            ->with([
                'color' => $colorAlert ?? 'success',
                'status' => "{$this->title} " . ($statusAlert ?? 'berhasil') . " diperbarui",
            ]);
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()->back()
            ->with([
                'color' => $colorAlert ?? 'success',
                'status' => "{$this->title} " . ($statusAlert ?? 'berhasil') . " dihapus",
            ]);
    }

    public function assigned() {
        return view('student.room.index', [
            'title' => 'Ruang Kelas',
            'rooms' => AssignmentStudent::where('student_id', Auth::user()->id)->get(),
        ]);

    }
}
