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
        return view('instructors.meets.show', [
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

        $meet->modules()->create([
            'content' => $request->content
        ]);

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
        //
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
    public function update(Request $request, Meet $meet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meet  $meet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meet $meet)
    {
        //
    }
}
