@extends('layouts.auth')

@push('title', $title)
@push('header', 'Daftar ' . $title)

@section('content')
    @if (session('status'))
        <div class="alert border border-{{ session('color') }} text-{{ session('color') }} mb-3 p-3 text-center">
            {{ session('status') }}</div>
    @endif

    <table class="table display nowrap" width="100%">
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
                        <code>{!! $shift->timeFormated('time_start') . ' &mdash; ' . $shift->timeFormated('time_end') !!}</code>
                    </td>
                    @for ($i = 1; $i <= 6; $i++)
                        <td class="text-center">
                            @php
                                $assignment = $assignments
                                    ->where('shift_id', $shift->id)
                                    ->where('day', $i)
                                    ->first();
                            @endphp
                            @if ($assignment)
                                <a href="{{ route('assignment.edit', ['shift' => $shift->id, 'day' => $i, 'assignment' => $assignment->id]) }}" class="small">
                                    {{ $assignment->subject->name }}
                                </a>
                            @else
                                <a class="btn btn-sm btn-success" href="{{ route('assignment.create', ['shift' => $shift->id, 'day' => $i]) }}" role="button">Tambah</a>
                            @endif
                        </td>
                    @endfor
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
