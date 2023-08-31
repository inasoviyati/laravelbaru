@extends('layouts.auth')

@push('title', $title)
@push('header', 'Daftar ' . $title)

@push('action')
@endpush

@section('content')
    <nav>
        <div class="nav nav-tabs h4" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Materi</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Tugas</button>
        </div>
    </nav>

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active mt-3" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                @for ($i = 1; $i <= 8; $i++)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-heading-{{ $i }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#materi-collapse-{{ $i }}" aria-expanded="false" aria-controls="flush-collapse-{{ $i }}">
                                Pertemuan {{ $i }}
                            </button>
                        </h2>
                        <div id="materi-collapse-{{ $i }}" class="accordion-collapse collapse" aria-labelledby="flush-heading-{{ $i }}" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body bg-white">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="accordion accordion-flush mt-3" id="accordionFlushExample2">
                @for ($i = 1; $i <= 8; $i++)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-heading-{{ $i }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-{{ $i }}" aria-expanded="false" aria-controls="flush-collapse-{{ $i }}">
                                Pertemuan {{ $i }}
                            </button>
                        </h2>
                        <div id="flush-collapse-{{ $i }}" class="accordion-collapse collapse" aria-labelledby="flush-heading-{{ $i }}" data-bs-parent="#accordionFlushExample2">
                            <div class="accordion-body bg-white">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
@endsection
