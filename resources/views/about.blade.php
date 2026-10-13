<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>О проекте - {{ config('app.name') }}</title>
</head>
<body>
    <nav>
        <a href="/">Главная</a> | 
        <a href="/about">О проекте</a> | 
        <a href="/contacts">Контакты</a> |
        <a href="/pets">Каталог</a> |
        <a href="/prav">Правила</a> |
        <a href="/booking">Записаться на приём</a>
    </nav>
    <hr>
    <h1>О проекте</h1>
    <p><strong>Студент:</strong> {{ $fio }} (Группа: {{ $group }})</p>
    <p><strong>Описание:</strong> {{ $description }}</p>
</body>
</html>
