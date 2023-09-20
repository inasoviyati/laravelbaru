@extends('layouts.auth')

@section('others')
    <div class="container px-0">
        <div class="row gx-4">

            @foreach ($collection as $item)
                <div class="col-sm-6 col-xl-3">
                    <a href="{{ route('instructor.class', ['assignment_students' => $assignment_students->id, 'slug' => $item['slug']]) }}" class="text-decoration-none">
                        <div class="card" style="background-color:black">
                            <img class="card-img-top" src="https://picsum.photos/id/{{ $item['image'] }}/400/200.jpg" alt="Card image" style="opacity: 0.15;">
                            <div class="card-img-overlay">
                                <h3 class="text-light">
                                    <i class="text-white me-1" data-feather="{{ $item['icon'] }}"></i>
                                    {{ $item['title'] }}
                                </h3>
                                <p class="text-secondary">Berisi detail {{ Str::lower($item['title']) }} dari kelas ini.</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div>
@endsection
