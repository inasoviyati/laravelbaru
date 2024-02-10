@extends('layouts.auth')

@section('others')
    <div class="container px-0">
        <div class="d-flex justify-content-between">
            <div class="h2">{{ $title }}</div>
            <a href="{{ route('instructor.class.create', ['assignment_students' => $assignment_students->id, 'slug' => 'modules']) }}" class="btn btn-lg btn-primary mb-3">Tambah</a>
        </div>
        <div class="row gx-5">
            @foreach ($modules as $module)
                <div class="col-md-6">
                    <a href="{{ route('instructor.class.show', ['assignment_students' => $assignment_students->id, 'slug' => 'modules', 'meet' => $module->meet_id]) }}" class="text-decoration-none">
                        <div class="d-flex align-items-center bg-white px-2 mb-4 shadow">
                            <div class="flex-shrink-0 bg-success ms-1 rounded-5">
                                <i class="m-4 text-white" data-feather="smile"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="p-3">
                                    <div class="text-muted">{{ date('d M Y', strtotime($module->meet->date)) }}</div>
                                    <div class="h3 mt-2">Pertemuan {{ $module->meet->number }}</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
