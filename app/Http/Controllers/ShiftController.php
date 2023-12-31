<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    protected $title = 'Data Shift';

    public function index()
    {
        return view('admin.shift.index', [
            'title' => $this->title,
            'shifts' => Shift::orderBy('name')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.shift.create', [
            'title' => $this->title,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:shifts,name',
            'time_start' => 'required|date_format:H:i',
            'time_end' => 'required|date_format:H:i|after:time_start',
        ], [
            'time_end.after' => 'harus berisi jam setelah mulai.',
            'time_start.date_format' => 'tidak cocok dengan format hh:mm.',
            'time_end.date_format' => 'tidak cocok dengan format hh:mm.',
        ]);

        Shift::create([
            'name' => $request->name,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end,
        ]);

        return redirect()->route('shift.index')
            ->with([
                'color' => $colorAlert ?? 'success',
                'status' => "{$this->title} " . ($statusAlert ?? 'berhasil') . " ditambahkan",
            ]);
    }

    public function show($day)
    {
        return abort(404);
    }

    public function edit(Shift $shift)
    {
        return view('admin.shift.edit', [
            'title' => $this->title,
            'shift' => $shift
        ]);
    }

    public function update(Request $request, Shift $shift)
    {
        $request->validate([
            'name' => 'required|string|unique:shifts,name,' . $shift->id,
            'time_start' => 'required|date_format:H:i',
            'time_end' => 'required|date_format:H:i|after:time_start',
        ], [
            'day.digits_between' => 'harus berisi Senin - Minggu.',
            'time_end.after' => 'harus berisi jam setelah mulai.',
            'time_start.date_format' => 'tidak cocok dengan format hh:mm.',
            'time_end.date_format' => 'tidak cocok dengan format hh:mm.',
        ]);

        Shift::find($shift->id)->update([
            'name' => $request->name,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end,
        ]);

        return redirect()->route('shift.index')
            ->with([
                'color' => $colorAlert ?? 'success',
                'status' => "{$this->title} " . ($statusAlert ?? 'berhasil') . " diperbarui",
            ]);
    }

    public function destroy(Shift $shift)
    {
        $shift->delete();

        return redirect()->back()
            ->with([
                'color' => $colorAlert ?? 'success',
                'status' => "{$this->title} " . ($statusAlert ?? 'berhasil') . " dihapus",
            ]);
    }
}
