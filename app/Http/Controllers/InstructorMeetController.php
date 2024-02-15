<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Meet;
use Illuminate\Http\Request;

class InstructorMeetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Assignment $assignment)
    {
        return view('instructors.meets.index', [
            'title' => 'Daftar Pertemuan',
            'meets' => $assignment->meetsOrderByDate,
            'assignment' => $assignment,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Assignment $assignment)
    {
        return view('instructors.meets.create', [
            'title' => null,
            'assignment' => $assignment
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Assignment $assignment)
    {
        $meet = $assignment->meets()->create([
            'date' => $request->date
        ]);

        $module = $meet->modules()->create([
            'content' => $request->content
        ]);

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs('uploads', $filename, 'public');
            $module->moduleAttachments()->create([
                'file_path' => $path
            ]);
        }

        return redirect()->route('instructors.assignments.meets.index', $assignment->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meet  $meet
     * @return \Illuminate\Http\Response
     */
    public function show(Assignment $assignment, Meet $meet)
    {
        return view('instructors.meets.show', [
            'title' => null,
            'assignment' => $assignment,
            'meet' => $meet,
            'module' => $meet->modules()->where('meet_id', $meet->id)->first(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meet  $meet
     * @return \Illuminate\Http\Response
     */
    public function edit(Meet $meet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meet  $meet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignment $assignment, Meet $meet)
    {
        $meet->update([
            'date' => $request->date
        ]);

        $meet->modules()->update([
            'content' => $request->content
        ]);

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs('uploads', $filename, 'public');
            $meet->modules()->moduleAttachments()->create([
                'file_path' => $path
            ]);
        }

        return redirect()->route('instructors.assignments.meets.index', $assignment->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meet  $meet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment, Meet $meet)
    {
        $meet->delete();

        return redirect()->route('instructors.assignments.meets.index', $assignment->id);
    }
}
