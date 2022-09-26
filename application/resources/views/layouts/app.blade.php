<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body, html {
            min-height: 100vh;
            overflow-y: auto;
        }

        #app {
            min-height: 100vh;
        }

        .connect-btn img, .connected-wallet-icon {
            width: 48px;
            height: 48px;
        }

        .change-wallet {
            display: none;
        }
    </style>
</head>
<body>
    <div id="app" class="d-flex flex-column justify-content-center">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <div class="d-inline-flex justify-content-start align-items-center gap-2">
                    <img height="25" src="{{ asset('images/logo.svg') }}" alt="Logo">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name') }}
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Right Side Of Navbar -->
                    @include('layouts.partials.nav')
                </div>
            </div>
        </nav>

        <main class="py-4 flex-fill d-flex flex-column justify-content-center">
            @include('layouts.partials.alerts')
            @yield('content')
        </main>
        <footer class="bg-secondary">
            <div class="container text-center py-4 text-white">
                <p class="d-flex justify-content-center align-content-center gap-2 mb-1">
                    Powered by <strong>GateKeeper</strong>
                    <a class="link-light" href="https://github.com/latheesan-k/GateKeeper" target="_blank">
                        View on Github
                    </a>
                </p>
                <p class="mb-0">
                    An open source project created by Adam K. Dean &amp; Latheesan Kanesamoorthy.<br />
                    Maintained by the Cardano community with <span class="fa fa-heart text-danger"></span>
                </p>
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>
</html>
