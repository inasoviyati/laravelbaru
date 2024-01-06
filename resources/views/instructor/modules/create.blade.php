@extends('layouts.auth')

@section('others')
    <div class="container px-0">
        <div class="d-flex justify-content-between">
            <div class="h2">{{ $title }}</div>
        </div>
        <form
            action="{{ route('instructor.class.store', ['assignment_students' => $assignment_students->id, 'slug' => 'modules']) }}"
            class="mt-4 card bg-white p-4" autocomplete="off" method="POST">
            @csrf
            <div class="row">
                <div class="form-row mb-3">
                    <div class="row">
                        <div class="form-group col-6">
                            <label>Pertemuan</label>
                            <select name="number" class="form-select" required>
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label>Tanggal</label>
                            <input type="text" name="date" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label>Isi</label>
                    <textarea name="content" class="form-control form-control-lg" required></textarea>
                </div>
                <div class="form-group mb-3">
                    <label>Lampiran</label>
                    <input type="file" name="attachment" class="form-control form-control-lg">
                </div>
                <div class="d-flex justify-content-between">
                    <a class="btn btn-lg btn-light"
                        href="{{ route('instructor.class.index', ['assignment_students' => $assignment_students->id, 'slug' => 'modules']) }}">Kembali</a>
                    <button class="btn btn-lg btn-primary">Tambah</button>
                </div>
            </div>
        </form>
    </div>
@endsection
