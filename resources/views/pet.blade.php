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
        <a href="{{ route('contacts') }}">Контакты</a> |
        <a href="{{ route('prav') }}">правила</a>
    </nav>

    <hr>
    <h1>Кличка питомца: {{ $book['title'] }}</h1>
    
    <ul>
        @foreach($book as $key => $value)
            @if($key !== 'title')
                <li><strong>{{ $key }}:</strong> {{ $value }}</li>
            @endif
        @endforeach
    </ul>
    <hr>
    <p>
        <a href="{{ route('welcom') }}">← В главную</a>
    </p>
</body>
</html>
