<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Контакты - {{ config('app.name') }}</title>
</head>
<body>
    <nav>
        <a href="{{ route('welcom') }}">Главная</a> | 
        <a href="{{ route('about') }}">О проекте</a> | 
        <a href="{{ route('contacts') }}">Контакты</a>
    </nav>
    <hr>
    <h1>Контакты организации</h1>
    <p><strong>Адрес:</strong> {{ $address }}</p>
    <p><strong>Телефон:</strong> {{ $phone }}</p>
    <p><strong>Email:</strong> {{ $email }}</p>
</body>
</html>
