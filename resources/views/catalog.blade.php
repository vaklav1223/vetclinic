<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Каталог питомцев</title>
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
    <h1>Каталог наших питомцев</h1>
    
    <ul>
        @foreach($items as $id => $item)
            <li>
                <a href="{{ route('pets.show', $id) }}">{{ $item['id'] }}</a>
            </li>
        @endforeach
    </ul>
</body>
</html>
