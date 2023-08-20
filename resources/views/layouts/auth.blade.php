<!DOCTYPE html>
<html lang="id">

<head>
    @include('layouts.header')
    @stack('css')
</head>

<body data-theme="light">
    <div class="d-flex h-100 w-100 bg-white position-absolute" style="z-index: 1100;" id="loadingSpinner">
        <div class="m-auto">
            <div class="spinner-border text-warning" style="background-image: url('{{ asset('img/icons/icon-48x48.png') }}'); background-size: contain; width: 48px; height: 48px; border: unset;"></div>
        </div>
    </div>
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

                @if (session('status'))
                    <div class="alert alert-{{ session('color') }} text-{{ session('color') }} mb-5 p-3 alert-dismissible fade show">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

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

            @yield('others')

            @include('layouts.footer')

        </div>
    </div>
    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/project.js') }}"></script>
    @stack('js')
</body>

</html>
