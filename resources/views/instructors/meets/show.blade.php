@extends('layouts.auth')

@section('others')
    <div class="container px-0">
        <div class="d-flex justify-content-between">
            <div class="h2">{{ $title }}</div>
        </div>
        <div class="mt-4 card bg-white p-4">
            <form action="{{ route('instructors.assignments.meets.update', ['assignment' => $assignment->id, 'meet' => $meet->id]) }}" autocomplete="off" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-row mb-3">
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Tanggal</label>
                                <input type="text" name="date" class="form-control" value="{{ $meet->date->format('Y-m-d') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label>Isi</label>
                        <textarea name="content" class="form-control form-control-lg" required>{{ optional($module)->content }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label>Lampiran</label>
                        <input type="file" name="attachment" class="form-control form-control-lg">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a class="btn btn-lg btn-light" href="{{ route('instructors.assignments.meets.index', $assignment->id) }}">Kembali</a>
                        <button class="btn btn-lg btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <form action="{{ route('instructors.assignments.meets.destroy', ['assignment' => $assignment->id, 'meet' => $meet->id]) }}" autocomplete="off" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-lg btn-danger">Hapus</button>
    </form>
@endsection
