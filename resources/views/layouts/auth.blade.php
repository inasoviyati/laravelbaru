<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('img/icons/icon-48x48.png') }}" />

    <title>Lab Inna</title>

    <link href="{{ asset('css/light.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body data-theme="light">
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="index.html">
                    <span class="align-middle">Lab SI & MI</span>
                </a>

                {{-- admin --}}
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        admin
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('dashboard.index')  }}">
                            <i class="align-middle" data-feather="sliders"></i> <span
                                class="align-middle">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('instructor.*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('instructor.index')  }}">
                            <i class="align-middle" data-feather="book"></i> <span class="align-middle">Data Instruktur</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('student.*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('student.index') }}">
                            <i class="align-middle" data-feather="book"></i> <span class="align-middle">Data Mahasiswa</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('instructorAttendance.*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('instructorAttendance.index') }}">
                            <i class="align-middle" data-feather="book"></i> <span class="align-middle">Absen Instruktur</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('studentAttendance.*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('studentAttendance.index') }}">
                            <i class="align-middle" data-feather="book"></i> <span class="align-middle">Absen Mahasiswa</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('room.*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('room.index') }}">
                            <i class="align-middle" data-feather="book"></i> <span class="align-middle">Ruang Kelas</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="pages-blank.html">
                            <i class="align-middle" data-feather="book"></i> <span class="align-middle">BAP</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="pages-blank.html">
                            <i class="align-middle" data-feather="book"></i> <span class="align-middle">Nilai</span>
                        </a>
                    </li>
                    
                    <li class="sidebar-header">
                        instruktur
                    </li>

                    {{-- instruktur --}}
                    
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="icons-feather.html">
                            <i class="align-middle" data-feather="coffee"></i> <span class="align-middle">Nilai</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="icons-feather.html">
                            <i class="align-middle" data-feather="coffee"></i> <span class="align-middle">BAP</span>
                        </a>
                    </li>
                    
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="icons-feather.html">
                            <i class="align-middle" data-feather="coffee"></i> <span class="align-middle">Absen Instruktur</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="icons-feather.html">
                            <i class="align-middle" data-feather="coffee"></i> <span class="align-middle">Absen Mahasiswa</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="icons-feather.html">
                            <i class="align-middle" data-feather="coffee"></i> <span class="align-middle">Ruang Tugas</span>
                        </a>
                    </li>



                    <li class="sidebar-header">
                        mahasiswa
                    </li>
                     
                      {{-- mahasiswa --}}

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="charts-chartjs.html">
                            <i class="align-middle" data-feather="bar-chart-2"></i> <span
                                class="align-middle">Ruang Kelas</span>
                        </a>
                    </li>
                </ul>

               
            
            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">

                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                                data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                                data-bs-toggle="dropdown">
                                <img src="{{ asset('img/avatars/avatar.jpg') }}" class="avatar img-fluid rounded me-1"
                                    alt="Charles Hall" /> <span class="text-dark">Charles Hall</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="pages-profile.html">
                                    <i class="align-middle me-1" data-feather="user"></i> Profil
                                </a>
                                <a class="dropdown-item" href="index.html">
                                    <i class="align-middle me-1" data-feather="settings"></i> Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Log out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">@yield('title','Page')</h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">@yield('action','')</h5>
                                </div>
                                <div class="card-body">
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <strong>Lab SI & MI</strong></a> &copy; <strong>{{ date('Y') }}</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>
