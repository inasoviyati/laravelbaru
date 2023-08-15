<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    protected $title = 'Ruang Kelas';

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
                'color' => 'success',
                'status' => "{$this->title} berhasil ditambahkan",
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
                'color' => 'success',
                'status' => "{$this->title} berhasil diperbarui",
            ]);
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()->back()
            ->with([
                'color' => 'success',
                'status' => "{$this->title} berhasil dihapus",
            ]);
    }
}
