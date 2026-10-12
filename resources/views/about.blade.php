<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>О проекте - {{ config('app.name') }}</title>
</head>
<body>
    <nav>
        <a href="{{ route('welcom') }}">Главная</a> | 
        <a href="{{ route('about') }}">О проекте</a> | 
        <a href="{{ route('contacts') }}">Контакты</a>
    </nav>
    <hr>
    <h1>О проекте</h1>
    <p><strong>Студент:</strong> {{ $fio }} (Группа: {{ $group }})</p>
    <p><strong>Описание:</strong> {{ $description }}</p>
</body>
</html>
