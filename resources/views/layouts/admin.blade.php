<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Админ-панель')</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f8f9fa; color: #333333; }
        .admin-header { background-color: #212529; padding: 15px; display: block; }
        .admin-header nav a { color: #ffffff; text-decoration: none; margin-right: 15px; padding: 5px 10px; display: inline-block; }
        .admin-header nav a.active { background-color: #dc3545; border-radius: 4px; }
        .content { max-width: 1200px; margin: 20px auto; padding: 0 15px; }
        .card { background: #ffffff; border: 1px solid #dee2e6; border-radius: 8px; padding: 20px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .badge { display: inline-block; padding: 5px 10px; font-size: 12px; background-color: #28a745; color: #ffffff; border-radius: 50px; }
        footer { text-align: center; padding: 20px; margin-top: 40px; background-color: #e9ecef; }
    </style>
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
