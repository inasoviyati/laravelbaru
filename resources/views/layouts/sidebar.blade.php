<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('dashboard.index') }}">
            <img src="{{ asset('img/logo/logo.png') }}" class="img-fluid" style="padding-left: 40px;padding-right: 40px;" alt="">
            {{-- <i><span class="align-middle">{{ config('app.name') }}</span></i> --}}
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-item {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('dashboard.index') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            @if(auth()->user()->role == 'admin')
            <li class="sidebar-header">
                Admin
            </li>
            <li class="sidebar-item {{ request()->routeIs('instructor.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('instructor.index') }}">
                    <i class="align-middle" data-feather="database"></i>
                    <span class="align-middle">Data Instruktur</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('student.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('student.index') }}">
                    <i class="align-middle" data-feather="database"></i>
                    <span class="align-middle">Data Mahasiswa</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('shift.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('shift.index') }}">
                    <i class="align-middle" data-feather="clock"></i>
                    <span class="align-middle">Data Jadwal</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('student.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('student.index') }}">
                    <i class="align-middle" data-feather="briefcase"></i>
                    <span class="align-middle">Penugasan</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('room.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('room.index') }}">
                    <i class="align-middle" data-feather="users"></i>
                    <span class="align-middle">Ruang Kelas</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('instructorAttendance.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('instructorAttendance.index') }}">
                    <i class="align-middle" data-feather="clipboard"></i>
                    <span class="align-middle">Absen Instruktur</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('studentAttendance.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('studentAttendance.index') }}">
                    <i class="align-middle" data-feather="clipboard"></i>
                    <span class="align-middle">Absen Mahasiswa</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('report.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('report.index') }}">
                    <i class="align-middle" data-feather="book"></i>
                    <span class="align-middle">BAP</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('score.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('score.index') }}">
                    <i class="align-middle" data-feather="book"></i>
                    <span class="align-middle">Nilai</span>
                </a>
            </li>
            @endif

            @if(auth()->user()->role == 'instructor')
            <li class="sidebar-header">
                Instruktur
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="icons-feather.html">
                    <i class="align-middle" data-feather="coffee"></i>
                    <span class="align-middle">Nilai</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="icons-feather.html">
                    <i class="align-middle" data-feather="coffee"></i>
                    <span class="align-middle">BAP</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="icons-feather.html">
                    <i class="align-middle" data-feather="coffee"></i>
                    <span class="align-middle">Absen
                        Instruktur</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="icons-feather.html">
                    <i class="align-middle" data-feather="coffee"></i>
                    <span class="align-middle">Absen
                        Mahasiswa</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="icons-feather.html">
                    <i class="align-middle" data-feather="coffee"></i>
                    <span class="align-middle">Ruang
                        Tugas</span>
                </a>
            </li>
            @endif

            @if(auth()->user()->role == 'student')
            <li class="sidebar-header">
                Mahasiswa
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="charts-chartjs.html">
                    <i class="align-middle" data-feather="bar-chart-2"></i>
                    <span class="align-middle">Ruang
                        Kelas</span>
                </a>
            </li>
            @endif

        </ul>
    </div>
</nav>
