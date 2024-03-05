@extends('layouts.auth')

@section('others')
    <div class="container px-0">
        <div class="d-flex justify-content-between">
            <div class="h2">{{ $title }}</div>
        </div>
        <form action="{{ route('instructors.assignments.meets.store', $assignment->id) }}" class="mt-4 card bg-white p-4" autocomplete="off" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-row mb-3">
                    <div class="row">
                        <div class="form-group col-6">
                            <label>Tanggal</label>
                            <input type="text" name="date" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label>Laporan Akhir</label>
                    <textarea name="content" class="form-control form-control-lg" required></textarea>
                </div>
                <div class="form-group mb-3">
                    <label>Laporan Awal</label>
                    <textarea name="content_start" class="form-control form-control-lg" required></textarea>
                </div>
                <div class="form-group mb-3">
                    <label>Lampiran</label>
                    <input type="file" name="attachment" class="form-control form-control-lg">
                </div>
                <div class="d-flex justify-content-between">
                    <a class="btn btn-lg btn-light" href="{{ route('instructors.assignments.meets.index', $assignment->id) }}">Kembali</a>
                    <button class="btn btn-lg btn-primary">Tambah</button>
                </div>
            </div>
        </form>
    </div>
@endsection
