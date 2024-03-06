@extends('layouts.auth')

@push('title', $title)
{{-- @push('header', 'Daftar ' . $title) --}}

{{-- @push('action')
@endpush --}}


@section('content')
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active mt-3" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                @foreach ($meets as $i => $meet)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-heading-{{ $i }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#materi-collapse-{{ $i }}" aria-expanded="false" aria-controls="flush-collapse-{{ $i }}">
                                Pertemuan {{ $loop->iteration }} <span class="mx-3 text-warning">|</span> {{ $meet->date->isoFormat('D MMMM YYYY') }}
                            </button>
                        </h2>
                        <div id="materi-collapse-{{ $i }}" class="accordion-collapse collapse" aria-labelledby="flush-heading-{{ $i }}" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body bg-white">
                                @if (optional($meet->modules->first())->content)
                                    <div class="text-warning mb-1">Laporan akhir:</div>
                                    {{ nl2br(optional($meet->modules->first())->content) }}
                                @endif

                                @if (optional($meet->modules->first())->content_start)
                                    <div class="text-warning mt-3 mb-1">Laporan awal:</div>
                                    {{ nl2br(optional($meet->modules->first())->content_start) }}
                                @endif

                                <form method="POST" class="mt-4" enctype="multipart/form-data" action="">
                                    @csrf
                                    <input type="file" name="file" class="form-control mb-3" required>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
