<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Только Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        .guest-card {
            max-width: 420px;
            margin: 0 auto;
        }
    </style>

    @stack('styles')
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100">
<div class="container py-4">
    <div class="guest-card">
        <!-- Логотип (просто и по центру) -->
        <div class="text-center mb-4">
            <a href="{{ route('main.index') }}" class="text-decoration-none">
                <img src="{{ asset('images/YjBjYjNhOGUtZGY1Zi00ZjM4L.png') }}"
                     alt="Logo"
                     height="50"
                     class="mb-3">
                <h4 class="text-muted">@yield('page-title', 'Вход в систему')</h4>
            </a>
        </div>

        <!-- Сообщения -->
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <!-- Контент страницы -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                @yield('content')
            </div>
        </div>

        <!-- Ссылка на главную -->
        <div class="text-center mt-3">
            <a href="{{ route('main.index') }}" class="text-decoration-none text-secondary">
                ← Вернуться на главную
            </a>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')
</body>
</html>
