<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Контакты - {{ config('app.name') }}</title>
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
    <h1>Контакты организации</h1>
    <p><strong>Адрес:</strong> {{ $address }}</p>
    <p><strong>Телефон:</strong> {{ $phone }}</p>
    <p><strong>Email:</strong> {{ $email }}</p>
</body>
</html>
