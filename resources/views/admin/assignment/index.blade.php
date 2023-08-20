@extends('layouts.auth')

@push('title', $title)
@push('header', 'Daftar ' . $title)
@push('css')
    <style>
        .link-cell {
            position: relative;
        }

        .link-overlay:hover {
            border: 1px solid #1cbb8c;
        }

        .link-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1;
        }
    </style>
@endpush
@section('content')
    <table class="table table-striped display nowrap border" width="100%">
        <thead>
            <tr class="text-center bg-light border">
                <th>Waktu</th>
                <th class="border">Senin</th>
                <th>Selasa</th>
                <th class="border">Rabu</th>
                <th>Kamis</th>
                <th class="border">Jumat</th>
                <th>Sabtu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shifts as $shift)
                <tr>
                    <td class="text-center">
                        {!! $shift->timeFormated('time_start') . ' <span class="mx-1" style="opacity: 0.4">&ndash;</span> ' . $shift->timeFormated('time_end') !!}
                    </td>
                    @for ($i = 1; $i <= 6; $i++)
                        <td class="text-center link-cell">
                            @php
                                $assignment = $assignments
                                    ->where('shift_id', $shift->id)
                                    ->where('day', $i)
                                    ->first();
                            @endphp
                            @if ($assignment)
                                <a href="{{ route('assignment.edit', ['shift' => $shift->id, 'day' => $i, 'assignment' => $assignment->id]) }}" class="link-overlay"></a>
                                <div class="fw-bold">{{ $assignment->subject->alias }}</div>
                                <div>{{ Str::words($assignment->instructor->name, 2, '...') }}</div>
                                <div class="text-muted">{{ $assignment->assignmentStudents->count() }} orang</div>
                            @else
                                <a href="{{ route('assignment.create', ['shift' => $shift->id, 'day' => $i]) }}" class="link-overlay"></a>
                            @endif
                        </td>
                    @endfor
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        <div class="text-muted small">
            <i class="align-middle text-info" data-feather="info"></i>
            Klik pada kolom kosong untuk tambah
        </div>
    </div>
@endsection
