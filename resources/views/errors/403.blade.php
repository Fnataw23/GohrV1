<!-- resources/views/errors/403.blade.php -->
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Доступ запрещён</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .error-card {
            text-align: center;
            padding: 3rem 4rem;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 90%;
            transition: transform 0.3s;
        }
        .error-card:hover {
            transform: translateY(-5px);
        }
        .error-code {
            font-size: 7rem;
            font-weight: bold;
            color: #dc3545;
        }
        .error-message {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }
        .error-description {
            color: #6c757d;
            font-size: 1.1rem;
        }

        @media (max-width: 576px) {
            .error-code {
                font-size: 5rem;
            }
            .error-message {
                font-size: 1.5rem;
            }
            .error-card {
                padding: 2rem;
            }
        }
    </style>
</head>
<body>
<div class="error-card">
    <div class="error-code">403</div>
    <div class="error-message">Доступ запрещён</div>
    <div class="error-description">У вас нет прав для просмотра этой страницы.</div>
</div>
</body>
</html>
