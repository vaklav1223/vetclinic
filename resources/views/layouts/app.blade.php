<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Ветеринарная клиника')</title>
    <link rel="stylesheet" href="site.css">
</head>
<body>
    <header>
        @include('partials.nav')
    </header>

    <main class="content">
        @yield('content')
    </main>

    @include('partials.footer')
</body>
</html>
