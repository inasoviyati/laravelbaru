<!DOCTYPE html>
<html lang="id">

<head>
    @include('layouts.header')
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

        label {
            margin-bottom: 8px;
        }
    </style>
    @stack('css')
</head>

<body data-theme="light">
    <div class="wrapper">

        @include('layouts.sidebar')

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>
                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <img src="https://dummyimage.com/64x64/3b7cdd/fff&text={{ mb_substr(auth()->user()->name, 0, 1) }}" class="avatar img-fluid rounded me-1" alt="avatar" />
                                <span class="text-dark">{{ Str::words(auth()->user()->name, 2, '...') }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="pages-profile.html">
                                    <i class="align-middle me-1" data-feather="user"></i> Profil
                                </a>
                                <a class="dropdown-item" href="index.html">
                                    <i class="align-middle me-1" data-feather="settings"></i> Pengaturan
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}">Keluar</a>
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

            @include('layouts.footer')

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
