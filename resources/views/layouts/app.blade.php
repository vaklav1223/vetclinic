<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Ветеринарная клиника')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        @include('partials.nav')
    </header>

    <main class="content">
        @yield('content')
    </main>

    @include('partials.footer')
    <footer style="margin-top: 50px; padding: 20px; background: #f1f3f5; text-align: center;">
    <p>Запросов к БД: {{ count(\Illuminate\Support\Facades\DB::getQueryLog()) }}</p>
</footer>

</body>
</html>
