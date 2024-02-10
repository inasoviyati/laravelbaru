@extends('layouts.auth')
@section('others')
    <div class="container px-0">
        <div class="d-flex justify-content-between">
            <div class="h2">{{ $title }}</div>
            <a href="{{ route('instructors.assignments.meets.create', [$assignment->id]) }}" class="btn btn-lg btn-primary mb-3">Buat Pertemuan</a>
        </div>
        <div class="col-8 mt-3">
            @foreach ($meets as $meet)
                <a href="{{ route('instructors.assignments.meets.show', [$meet->assignment->id, $meet->id]) }}" class="text-decoration-none">
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-auto">
                                <img src="https://dummyimage.com/128x128/3b7cdd/ffffff&text= {{ $meet->date->format('j M') }} " class="img-fluid rounded-start h-100" alt="...">
                            </div>
                            <div class="col">
                                <div class="card-body">
                                    <div class="text-muted">
                                        Pertemuan {{ $loop->iteration }}
                                    </div>
                                    <div class="progress my-3" style="height: 5px;">
                                        <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" style="width: 75%"></div>
                                    </div>
                                    <div class="text-muted">
                                        <i data-feather="user" class="text-primary"></i> {{ $meet->assignment->assignmentStudents()->count() }}
                                        <i data-feather="clock" class="ms-2 text-primary"></i> {{ $meet->date->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
