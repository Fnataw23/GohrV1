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
        .ministry-wrap { display: flex; align-items: flex-start; gap: 14px; max-width: 520px; }
        .ministry-logo img { height: 92px;}
        .ministry-title { font-size: 14px; font-weight: 600; line-height: 1.25; }
        .ministry-subtitle { font-size: 13px; line-height: 1.2; margin-top: 2px; }
        .navbar-right { margin-left: auto; }
        .navbar-nav .nav-link { padding: 12px 18px; }
        .navbar-center { position: absolute; left: 50%; transform: translateX(-50%);}
        .navbar-center .nav-link { padding: 12px 18px; white-space: nowrap; }
    </style>
</head>
<body>
<div>
    <div class="container-fluid">
        <!-- Навигация -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm mb-4 position-relative">
            <div class="container-fluid">
                <!-- ЛЕВО: герб + название -->
                <div class="ministry-wrap">
                    <a href="{{ route('main.index') }}" class="ministry-logo">
                        <img src="{{ asset('images/YjBjYjNhOGUtZGY1Zi00ZjM4L.png') }}" alt="Герб">
                    </a>
                    <div class="ministry-text">
                        <div class="ministry-title mt-4">
                            Министерство природных ресурсов и экологии
                        </div>
                        <div class="ministry-title">
                            Ростовской области
                        </div>
                    </div>
                </div>
                <!-- ЦЕНТР: МЕНЮ -->
                <div class="navbar-center">
                    <ul class="navbar-nav flex-row">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('main.index')
                || request()->routeIs('applications.*') && !request()->routeIs('applications.create.*')
                ? 'active' : '' }}"
                               href="{{ route('main.index') }}">
                                Главная
                            </a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('applications.create.*') ? 'active' : '' }}"
                                   href="{{ route('applications.create.step1') }}">
                                    Принять заявку
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Запрос в ГИЦ
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('reports.index') ? 'active' : '' }}"
                                   href="{{ route('reports.index') }}">
                                    Отчеты
                                </a>
                            </li>

                            <!-- Кнопка Админка — только для админов -->
                            @if(auth()->user()->role === 'admin')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('platform.*') ? 'active' : '' }}"
                                       href="{{ route('platform.main') }}">
                                        Админка
                                    </a>
                                </li>
                            @endif

                            @unless(Auth::user()->inRole('admin'))
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('settings.*') ? 'active' : '' }}"
                                       href="{{ route('settings.index') }}">
                                        Настройки
                                    </a>
                                </li>
                            @endunless
                        @endauth

                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Войти</a>
                            </li>
                        @endguest
                    </ul>
                </div>
                <!-- ПРАВО: выход -->
                <div class="navbar-right">
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-link nav-link">Выйти</button>
                        </form>
                    @endauth
                </div>
            </div>
        </nav>
        <div class="container">
            @yield('content')
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js"></script>

</body>
</html>
