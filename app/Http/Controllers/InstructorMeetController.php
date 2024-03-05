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
            'content' => $request->content,
            'content_start' => $request->content_start
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
            'assignmentStudents' => $assignment->assignmentStudents()->get(),

            'hadir' => $meet->attendances()->where('status', 'H')->count(),
            'sakit' => $meet->attendances()->where('status', 'S')->count(),
            'izin' => $meet->attendances()->where('status', 'I')->count(),
            'alpa' => $meet->attendances()->where('status', 'A')->count(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meet  $meet
     * @return \Illuminate\Http\Response
     */
    public function attendances(Request $request, Assignment $assignment, Meet $meet)
    {
        foreach ($request->status as $key => $value) {
            $meet->attendances()->updateOrCreate([
                'student_id' => $key,
                'meet_id' => $meet->id
            ], [
                'status' => $value
            ]);
        }

        return redirect()->route('instructors.assignments.meets.show', [$assignment->id, $meet->id]);
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

        $meet->modules()->updateOrCreate([
            'meet_id' => $meet->id
        ], [
            'content' => $request->content,
            'content_start' => $request->content_start,
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
