@extends('layouts.auth')

{{-- @push('title', $title) --}}
{{-- @push('header', 'Daftar ' . $title) --}}

@push('action')
@endpush

@section('others')
    <div class="container px-0">
        <div class="row gx-5">
            @foreach ($rooms as $room)
                <div class="col-md-6">
                    <a href="{{ route('room.assigned.detail', ['room' => $room->id]) }}" class="text-decoration-none">
                        <div class="d-flex align-items-center bg-white px-2 mb-4 shadow">
                            <div class="flex-shrink-0 bg-success ms-1 rounded-5">
                                <i class="m-4 text-white" data-feather="smile"></i>
                                {{-- <img class="img-fluid rounded-start-5" src="https://dummyimage.com/100x96/555555/fff&text= {{ $room->assignment->subject->alias }} " alt="..."> --}}
                            </div>
                            <div class="flex-grow-1">
                                <div class="p-3">
                                    <div class="text-muted">{{ $room->assignment->instructor->name }}</div>
                                    <div class="h3 mt-2">{{ $room->assignment->subject->name }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="https://dummyimage.com/200x200/3b7cdd/fff&text={{ $room->assignment->subject->alias }}" class="img-fluid rounded-start" alt="">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body bg-light">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="p-3 border bg-light">
                            <div class="text-muted">{{ $room->assignment->instructor->name }}</div>
                            <div class="h1">{{ $room->assignment->subject->name }}</div>
                        </div> --}}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
