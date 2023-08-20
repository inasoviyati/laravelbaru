<!DOCTYPE html>
<html lang="id">

<head>
    @include('layouts.header')
</head>

<body>

    <div class="d-flex h-100 w-100 bg-white position-absolute" style="z-index: 1100;" id="loadingSpinner">
        <div class="m-auto">
            <div class="spinner-border text-warning" style="background-image: url('{{ asset('img/icons/icon-48x48.png') }}'); background-size: contain; width: 48px; height: 48px; border: unset;"></div>
        </div>
    </div>

    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">
                        <div class="text-center my-4">
                            <div class="text-center">
                                <img src="{{ asset('img/logo/logo.png') }}" class="img-fluid w-50" alt="">
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center mb-4">
                                    <h1 class="h2">Selamat datang!</h1>
                                    <p class="lead">
                                        Masuk ke akun Anda untuk melanjutkan
                                    </p>
                                </div>
                                <div class="m-sm-3">
                                    @if ($errors->any())
                                        <div class="alert alert-danger text-danger p-3">
                                            {!! implode('', $errors->all('<div>:message</div>')) !!}
                                        </div>
                                    @endif
                                    <form action="{{ route('login.auth') }}" method="POST" autocomplete="off">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input class="form-control form-control-lg" type="text" name="email" placeholder="Masukkan email" required />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input class="form-control form-control-lg" type="password" name="password" placeholder="Masukkan password" value="password" required />
                                        </div>
                                        <div>
                                            <div class="form-check align-items-center">
                                                <input id="customControlInline" type="checkbox" class="form-check-input" value="1" name="remember" checked>
                                                <label class="form-check-label text-small" for="customControlInline">Tetap masuk</label>
                                            </div>
                                        </div>
                                        <div class="d-grid gap-2 mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary">Masuk</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/project.js') }}"></script>
</body>

</html>
