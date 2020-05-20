<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sunshine Laundry') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="login">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-5 ml-auto mr-auto">
                <div class="system-title text-center mb-2">LAUNDRY MANAGEMENT SYSTEM</div>
                <p class="system-info text-center">SUNSHINE LINEN SERVICES</p>
                <p class="system-info text-center mb-2">COMMERCIAL DRY CLEANERS</p>
                <div class="card p-4 card-login shadow-lg">
                    <div class="avatar mb-3"><img src="./images/avatar.png" class="img-fluid" alt=""></div>
                    <div class="page-title text-center mb-3">{{ __('LOGIN') }}</div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <div class="col-md-10 offset-0">
                                <button type="submit" class="btn btn-warning">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--./col-6-->
        </div>
        <!--./row-->
    </div>
    <!--./container-->
</body>

</html>