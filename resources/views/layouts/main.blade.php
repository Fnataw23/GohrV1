<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .logo-img { max-width: 100%; height: auto; max-height: 100px; }
        .navbar-nav { display: flex; justify-content: center; width: 100%; }
        .nav-link:hover { color: #0d6efd; text-decoration: underline; }
        .card-custom { border-radius: 15px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        .navbar-toggler { border: none; }
        .navbar-toggler-icon { background-color: #0d6efd; }
        .nav-item .nav-link { padding: 12px 18px; transition: all 0.3s ease-in-out; }
    </style>
</head>
<body>
<div>
    <div class="container-fluid">
        <!-- Навигация -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('main.index') }}">
                    <img src="{{ asset('images/YjBjYjNhOGUtZGY1Zi00ZjM4L.png') }}" alt="Logo" class="logo-img">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0 justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('main.index') || request()->routeIs('applications.*') && !request()->routeIs('applications.create.*') ? 'active' : '' }}"
                               href="{{ route('main.index') }}">Главная</a>
                        </li>

                        @auth
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('applications.create.*') ? 'active' : '' }}"
                                   href="{{ route('applications.create.step1') }}">Принять заявку</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Запрос в Гиц</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('reports.index') ? 'active' : '' }}"
                                   href="{{ route('reports.index') }}">Отчеты</a>
                            </li>

                            @if(Auth::user()->inRole('admin'))
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('platform.*') ? 'active' : '' }}"
                                       href="{{ route('platform.main') }}">Админка</a>
                                </li>
                            @endif

                            <!-- Кнопка выхода -->
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="nav-link btn btn-link">Выйти</button>
                                </form>
                            </li>
                        @else
                            <!-- Кнопка входа -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Войти</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Контент -->
        <div class="container">
            @yield('content')
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
