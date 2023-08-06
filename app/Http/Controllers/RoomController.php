<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.room.index', [
            'rooms' => Room::orderBy('name')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.room.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
                'color' => 'success', // success / danger
                'status' => 'Kelas berhasil dtambahkan',
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        return view('admin.room.show', [
            'room' => $room,
            'students' => User::where('role', '!=', 'admin')->where(function ($query) use ($room) {
                $query->select('room_id')
                    ->from('room_users')
                    ->whereColumn('room_users.student_id', 'users.id')
                    ->limit(1);
            }, $room->id)->orderBy('name')->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        return view('admin.room.edit', [
            'room' => $room
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        Room::find($room->id)->update([
            'name' => $request->name,
        ]);

        return redirect()->route('room.index')
            ->with([
                'color' => 'success', // success / danger
                'status' => 'Kelas berhasil diperbarui',
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()->back()
            ->with([
                'color' => 'success', // success / danger
                'status' => 'Mahasiswa berhasil dihapus',
            ]);
    }
}
