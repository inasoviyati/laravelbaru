@extends('layouts.auth')

@section('others')
    <div class="container px-0">
        <div class="d-flex justify-content-between">
            <div class="h2">{{ $title }}</div>
        </div>

        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#nav-tugas-akhir" type="button" role="tab">Modul</button>
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-absen" type="button">Absen</button>
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-nilai" type="button">Nilai</button>
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-bap" type="button">Berita Acara Praktikum</button>
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-tugas-akhir">

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
                                <label>Laporan Akhir</label>
                                <textarea name="content" class="form-control form-control-lg" required>{{ optional($module)->content }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label>Laporan Awal</label>
                                <textarea name="content_start" class="form-control form-control-lg" required>{{ optional($module)->content_start }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label>Asisten</label>
                                <select name="assistances[]" class="form-select" multiple>
                                    @foreach ($instructors as $instructor)
                                        <option value="{{ $instructor->id }}" {{ in_array($instructor->id, $meet->assistances->pluck('instructor_id')->toArray()) ? 'selected' : '' }}>{{ $instructor->name }}</option>
                                    @endforeach
                                </select>
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
                <form action="{{ route('instructors.assignments.meets.destroy', ['assignment' => $assignment->id, 'meet' => $meet->id]) }}" autocomplete="off" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-lg btn-danger">Hapus</button>
                </form>

            </div>

            <div class="tab-pane fade" id="nav-absen" role="tabpanel">

                <form action="{{ route('instructors.assignments.meets.attendance', ['assignment' => $assignment->id, 'meet' => $meet->id]) }}" autocomplete="off" method="POST">
                    @csrf
                    <div class="mt-4 card bg-white p-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assignmentStudents as $assignmentStudent)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $assignmentStudent->user->npm }}</td>
                                        <td>{{ $assignmentStudent->user->name }}</td>
                                        <td>
                                            <select class="form-select" name="status[{{ $assignmentStudent->user->id }}]">
                                                @php
                                                    $attendance = $meet
                                                        ->attendances()
                                                        ->where('student_id', $assignmentStudent->user->id)
                                                        ->first();
                                                @endphp

                                                <option value="H" {{ $attendance && $attendance->status === 'H' ? 'selected' : '' }}>Hadir</option>
                                                <option value="S" {{ $attendance && $attendance->status === 'S' ? 'selected' : '' }}>Sakit</option>
                                                <option value="I" {{ $attendance && $attendance->status === 'I' ? 'selected' : '' }}>Izin</option>
                                                <option value="A" {{ $attendance && $attendance->status === 'A' ? 'selected' : '' }}>Alpha</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-lg btn-primary">Update</button>
                        </div>
                    </div>
                </form>

            </div>

            <div class="tab-pane fade" id="nav-nilai" role="tabpanel">

                <form action="{{ route('instructors.assignments.meets.score', ['assignment' => $assignment->id, 'meet' => $meet->id]) }}" autocomplete="off" method="POST">
                    @csrf
                    <div class="mt-4 card bg-white p-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assignmentStudents as $assignmentStudent)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $assignmentStudent->user->npm }}</td>
                                        <td>{{ $assignmentStudent->user->name }}</td>
                                        <td>
                                            @php
                                                $score = $meet
                                                    ->scores()
                                                    ->where('student_id', $assignmentStudent->user->id)
                                                    ->first();
                                            @endphp

                                            <input type="number" class="form-control" name="status[{{ $assignmentStudent->user->id }}]" value="{{ optional($score)->score }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-lg btn-primary">Update</button>
                        </div>
                    </div>
                </form>

            </div>

            <div class="tab-pane fade" id="nav-bap" role="tabpanel">

                <div class="mt-4 card bg-white p-4">
                    <table>
                        <tr>
                            <th style="width: 9.14cm;"></th>
                            <th style="width: 2.43cm;"></th>
                            <th style="width: 14.43cm;"></th>
                            <th style="width: 8.43cm;"></th>
                            <th style="width: 8.43cm;"></th>
                            <th style="width: 8.43cm;"></th>
                            <th style="width: 8.43cm;"></th>
                            <th style="width: 8.43cm;"></th>
                            <th style="width: 8.43cm;"></th>
                        </tr>
                        <tr>
                            <td colspan="9"><br />
                                <p align="center" class="fw-bold">BERITA ACARA PRAKTIKUM (BRIEFING)</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="1">Pada Tanggal </td>
                            <td>:</td>
                            <td>{{ $date = \Carbon\Carbon::parse($meet->date)->isoFormat('D MMMM YYYY') }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="1">Shift </td>
                            <td>:</td>
                            <td>{{ $assignment->shift->name . ' (' . $assignment->shift->time_start->format('H:i') . ' - ' . $assignment->shift->time_start->format('H:i') . ')' }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="1">Kelas</td>
                            <td>:</td>
                            <td>{{ $assignment->assignmentStudents()->first()->user->roomUser->room->name }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="1">Materi </td>
                            <td>:</td>
                            <td>{{ $assignment->subject->name }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="9"> <br />Telah dilaksanakan Kegiatan Praktikum dengan rincian sebagai berikut:</td>
                        </tr>
                        <tr>
                            <td colspan="9"><br />A. Peserta Praktikum</td>
                        </tr>
                        <tr>
                            <td colspan="1">Jumlah Hadir</td>
                            <td>:</td>
                            <td>{{ $hadir }} orang</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="1">Sakit</td>
                            <td>:</td>
                            <td>{{ $sakit }} orang</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="1">Izin</td>
                            <td>:</td>
                            <td>{{ $izin }} orang</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="1">Tanpa Keterangan</td>
                            <td>:</td>
                            <td>{{ $alpa }} orang</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="9"><br />B. Laporan Praktikum (Laporan Akhir)</td>
                        </tr>
                        <tr>
                            <td>{!! nl2br(optional($meet->modules->first())->content) !!}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="9"><br />C. Tugas Minggu Berikutnya (Laporan Awal)</td>
                        </tr>
                        <tr>
                            <td>{!! nl2br(optional($meet->modules->first())->content_start) !!}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="9"><br />D. Ketua Asisten dan Asisten : </td>
                        </tr>
                        <tr>
                            <td>Ketua Asisten</td>
                            <td>:</td>
                            <td>{{ auth()->user()->name }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="1" valign="top">Asisten</td>
                            <td valign="top">:</td>
                            <td colspan="2">
                                <ol style="margin: 0; padding-left: 15px">
                                    @foreach ($meet->assistances as $assistance)
                                        <li>{{ $assistance->instructor->name }}</li>
                                    @endforeach
                                </ol>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td></td>
                            <td colspan="2"><br /><br />Jakarta, {{ $date }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td></td>
                            <td><br />Mengetahui,</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="1"></td>
                            <td colspan="2"><br /><br />LAB SI MI</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><br /><br />Ketua Asisten</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="1"></td>
                            <td colspan="2"><br /><br /><br /><br />(Yudi Irawan)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><br /><br /><br /><br />({{ auth()->user()->name }})</td>
                            <td></td>
                        </tr>

                    </table>
                </div>

            </div>
        </div>
    @endsection
