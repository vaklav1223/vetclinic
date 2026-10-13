<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
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
    <h1>{{ config('app.name') }}</h1>
    <p>Сегодня: {{ now()->format('d.m.Y') }}</p>
    @if(isset($items) && count($items) > 0)
    
@endif
</body>
</html>
