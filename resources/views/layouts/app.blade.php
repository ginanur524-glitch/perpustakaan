<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body style="background-color: #F5E6D3;">
    <div id="app">

        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm"
             style="background: linear-gradient(to right, #C19A6B, #A67B5B);">
            <div class="container">

                <!-- BRAND -->
                <a class="navbar-brand fw-bold text-white" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <!-- TOGGLER -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- LEFT MENU -->
                    <ul class="navbar-nav me-auto">
                        @auth
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/buku">Buku</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/peminjaman">Peminjaman</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/siswa">Siswa</a>
                        </li>
                        @endauth
                    </ul>

                    <!-- RIGHT MENU -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('login') }}">
                                        {{ __('Login') }}
                                    </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">
                                        {{ __('Register') }}
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown"
                                   class="nav-link dropdown-toggle text-white"
                                   href="#"
                                   role="button"
                                   data-bs-toggle="dropdown"
                                   aria-haspopup="true"
                                   aria-expanded="false"
                                   v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end"
                                     aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item"
                                       href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form"
                                          action="{{ route('logout') }}"
                                          method="POST"
                                          class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>

                </div>
            </div>
        </nav>

        <!-- CONTENT -->
        <main class="py-4">
            @yield('content')
        </main>

    </div>
</body>
</html>
