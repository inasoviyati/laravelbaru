<!DOCTYPE html>
<html lang="id">

<head>
    <title>Lab SI & MI</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">    
    <link rel="shortcut icon" href="{{ asset('img/icons/icon-48x48.png') }}" />
    <link rel="stylesheet" href="{{ asset('css/light.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/responsive.bootstrap5.min.css') }}" />

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        table.dataTable.dtr-inline.collapsed>tbody>tr>td.dtr-control::before,
        table.dataTable.dtr-inline.collapsed>tbody>tr>th.dtr-control::before {
            background-color: unset;
        }

        table.dataTable.dtr-inline.collapsed>tbody>tr>td.dtr-control::before,
        table.dataTable.dtr-inline.collapsed>tbody>tr>th.dtr-control::before {
            content: "✚";
        }

        table.dataTable.dtr-inline.collapsed>tbody>tr.parent>td.dtr-control::before,
        table.dataTable.dtr-inline.collapsed>tbody>tr.parent>th.dtr-control::before {
            background-color: unset;
        }

        table.dataTable.dtr-inline.collapsed>tbody>tr.parent>td.dtr-control::before,
        table.dataTable.dtr-inline.collapsed>tbody>tr.parent>th.dtr-control::before {
            content: "⚊";
        }

        div.dataTables_wrapper div.dataTables_length select {
            min-width: 68px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: unset;
            margin-left: 0px;
            border: unset;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            border: unset
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
            cursor: default;
            color: #666 !important;
            border: none;
            background: none;
            box-shadow: none;
        }

        table.dataTable>thead>tr>th {
            text-align: center
        }

        table.dataTable>tbody>tr>td:last-child {
            text-align: right
        }

        label{
            margin-bottom: 8px;
        }
    </style>
    @stack('css')
</head>

<body data-theme="light">
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="index.html">
                    <span class="align-middle">Lab SI & MI</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-item {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('dashboard.index') }}">
                            <i class="align-middle" data-feather="sliders"></i> <span
                                class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Admin
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('instructor.*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('instructor.index') }}">
                            <i class="align-middle" data-feather="book"></i>
                            <span class="align-middle">Data Instruktur</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('student.*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('student.index') }}">
                            <i class="align-middle" data-feather="book"></i>
                            <span class="align-middle">Data Mahasiswa</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('room.*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('room.index') }}">
                            <i class="align-middle" data-feather="book"></i>
                            <span class="align-middle">Ruang Kelas</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('instructorAttendance.*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('instructorAttendance.index') }}">
                            <i class="align-middle" data-feather="book"></i>
                            <span class="align-middle">Absen Instruktur</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('studentAttendance.*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('studentAttendance.index') }}">
                            <i class="align-middle" data-feather="book"></i>
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
                                <img src="{{ asset('img/avatars/avatar.jpg') }}"
                                    class="avatar img-fluid rounded me-1" alt="Charles Hall" /> <span
                                    class="text-dark">Charles Hall</span>
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
                    <h1 class="h3 mb-3">@stack('title')</h1>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <div class="card-title my-auto">@stack('header', '')</div>
                                        @stack('action')
                                    </div>
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
    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        const req = $('input[required], select[required]')
        const form = $('form')

        if (req.length) {
            req.parent().find('label').append('<span class="text-danger ms-1">*</span>')
            $('* div.form-group:last').after('<div class="mb-4 w-100 text-muted"><span class="text-danger ms-1">*</span>) Wajib diisi</div>')
        }

        if (form) {
            form.attr('autocomplete', 'off')
        }
    </script>
    @stack('js')
</body>

</html>
