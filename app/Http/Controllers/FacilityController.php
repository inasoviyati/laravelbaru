<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    protected $title = 'Data Fasilitas';

    public function index()
    {
        return view('admin.facility.index', [
            'title' => $this->title,
            'facilities' => Facility::orderBy('name')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.facility.create', [
            'title' => $this->title,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        Facility::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('facility.index')
            ->with([
                'color' => $colorAlert ?? 'success',
                'status' => "{$this->title} " . ($statusAlert ?? 'berhasil') . " ditambahkan",
            ]);
    }

    public function show(Facility $facility)
    {
        return view('admin.facility.show', [
            'title' => $this->title,
            'facility' => $facility,        ]);
    }

    public function edit(Facility $facility)
    {
        return view('admin.facility.edit', [
            'title' => $this->title,
            'facility' => $facility
        ]);
    }

    public function update(Request $request, Facility $facility)
    {
        Facility::find($facility->id)->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('facility.index')
            ->with([
                'color' => $colorAlert ?? 'success',
                'status' => "{$this->title} " . ($statusAlert ?? 'berhasil') . " diperbarui",
            ]);
    }

    public function destroy(Facility $facility)
    {
        $facility->delete();

        return redirect()->back()
            ->with([
                'color' => $colorAlert ?? 'success',
                'status' => "{$this->title} " . ($statusAlert ?? 'berhasil') . " dihapus",
            ]);
    }
}
