<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Админ-панель')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="admin-header">
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Панель</a> | 
            <a href="{{ route('admin.pets') }}" class="{{ request()->routeIs('admin.pets') || request()->routeIs('admin.pets.create') ? 'active' : '' }}">Питомцы</a> | 
            <a href="{{ route('admin.logout') }}">Выход</a>
        </nav>
    </header>

    <main class="content">
        @yield('content')
    </main>

    @include('partials.footer')
</body>
</html>
