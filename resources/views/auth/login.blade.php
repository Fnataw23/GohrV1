<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Вход в систему</title>

    <!-- Только Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f5f5;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
<div class="login-card p-4">
    <!-- Логотип -->
    <div class="text-center mb-4">
        <img src="{{ asset('images/YjBjYjNhOGUtZGY1Zi00ZjM4L.png') }}"
             alt="Logo"
             height="50">
        <h4 class="mt-3 mb-2">Вход в систему</h4>
    </div>

    <!-- Сообщения об ошибках -->
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Форма входа -->
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Логин -->
        <div class="mb-3">
            <label for="login" class="form-label">Логин</label>
            <input type="text"
                   id="login"
                   name="login"
                   class="form-control"
                   value="{{ old('login') }}"
                   required
                   autofocus
                   placeholder="Введите логин">
        </div>

        <!-- Пароль -->
        <div class="mb-4">
            <label for="password" class="form-label">Пароль</label>
            <input type="password"
                   id="password"
                   name="password"
                   class="form-control"
                   required
                   placeholder="Введите пароль">
        </div>

        <!-- Кнопка входа -->
        <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
            Войти
        </button>

        <!-- Ссылка на главную -->

    </form>

    <!-- Информация для пользователя -->
    <div class="mt-4 pt-3 border-top text-center">
        <small class="text-muted">
            Для получения доступа обратитесь к администратору
        </small>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Автофокус на поле логина
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('login').focus();
    });
</script>
</body>
</html>
