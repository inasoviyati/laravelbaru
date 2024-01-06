<?php

namespace App\Http\Controllers;

use App\Models\AssignmentStudent;
use App\Models\Meet;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AssignmentStudent $assignment_students, $slug = null)
    {
        switch ($slug) {
            case 'modules':
                return view('instructor.modules.index', [
                    'title' => 'Daftar Tugas',
                    'assignment_students' => $assignment_students,
                    'modules' => Module::get(),
                ]);
                break;

            default:
                $collection = [
                    ['icon' => 'calendar', 'title' => 'Jadwal', 'slug' => 'calendar', 'image' => 357],
                    ['icon' => 'clipboard', 'title' => 'Tugas', 'slug' => 'modules', 'image' => 4],
                    ['icon' => 'edit', 'title' => 'Nilai', 'slug' => 'score', 'image' => 7],
                    ['icon' => 'book', 'title' => 'BAP', 'slug' => 'bap', 'image' => 24],
                ];

                return view('instructor.menu.index', [
                    'title' => 'Menu',
                    'assignment_students' => $assignment_students,
                    'collection' => $collection,
                ]);
                break;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(AssignmentStudent $assignment_students, $slug = null)
    {
        switch ($slug) {
            case 'modules':
                return view('instructor.modules.create',[
                    'title' => 'Tambah Tugas',
                    'assignment_students' => $assignment_students,
                ]);
                break;
            
            default:
                abort(404);
                break;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AssignmentStudent $assignment_students, $slug = null)
    {
        switch ($slug) {
            case 'modules':
                $meet = Meet::create([
                    'number' => $request->number,
                    'assignment_id' => $assignment_students->assignment_id,
                    'date' => $request->date,
                ]);

                $meet->modules()->create([
                    'content' => $request->content
                ]);

                return redirect()->back();
                break;
            
            default:
                # code...
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show(Module $module)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module)
    {
        //
    }
}
