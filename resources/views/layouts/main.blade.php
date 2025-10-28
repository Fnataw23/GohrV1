<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div class="container">
    <div class="row">
        <nav>
            <ul>
                <li><a href="{{route('main.index')}}">Главная</a></li>
                <li><a href="{{route('application.index')}}">Заявки</a></li>
                <li><a href="{{ route('reports.index') }}">Отчёты</a></li>
                <li><a href="{{ route('about.index') }}">О проекте</a></li>
            </ul>
        </nav>
    </div>
    @yield('content')
</div>
</body>
</html>
