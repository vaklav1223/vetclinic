<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Доступ запрещён</title>
</head>
<body>
    <h1 style="font-size: 72px; color: red; margin-bottom: 0;">403</h1>
    <h2>Доступ запрещён</h2>
    <p><strong>Причина:</strong> {{ $exception->getMessage() }}</p>
    
    <p>
        <a href="{{ route('welcom') }}">На главную</a>
    </p>
</body>
</html>
