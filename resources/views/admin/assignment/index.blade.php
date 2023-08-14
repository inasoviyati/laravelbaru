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
            <tr>
                <th>Waktu</th>
                <th>Senin</th>
                <th>Selasa</th>
                <th>Rabu</th>
                <th>Kamis</th>
                <th>Jumat</th>
                <th>Sabtu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shifts as $shift)
                <tr>
                    <td><code>{!! $shift->timeFormated('time_start') . ' &mdash; ' . $shift->timeFormated('time_end') !!}</code></td>
                    @for ($i = 1; $i <= 6; $i++)
                        <td>
                            @php
                                $assignment = $assignments
                                    ->where('shift_id', $shift->id)
                                    ->where('day', $i)
                                    ->first();
                            @endphp
                            @if ($assignment)
                                <small>{{ $assignment->subject->name }}</small>
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
