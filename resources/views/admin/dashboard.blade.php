<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Панель администратора</title>
</head>
<body>
    <h1>Панель администратора</h1>
    <nav>
        <!-- Ссылки на остальные страницы раздела по условию задания -->
        <a href="{{ route('admin.pets') }}">Управление питомцами (Таблица)</a> | 
        <a href="{{ route('admin.pets.create') }}">Добавить питомца (Форма)</a> | 
        <a href="{{ route('welcom') }}">Выйти на сайт</a>
    </nav>
</body>
</html>
