<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Питомец №{{ $id }}</title>
</head>
<body>
    <nav>
        <a href="{{ route('welcom') }}">Главная</a> | 
        <a href="{{ route('about') }}">О проекте</a> | 
        <a href="{{ route('contacts') }}">Контакты</a>
    </nav>
    <hr>
    <h1>Питомец №{{ $id }}</h1>
</body>
</html>
