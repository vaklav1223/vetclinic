<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Админ-панель')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<header style="display: flex; justify-content: space-between; align-items: center; padding: 10px 20px; background-color: #212529; color: #fff; font-family: Arial, sans-serif;">
    <div style="display: flex; align-items: center; gap: 20px;">
        <strong style="font-size: 16px; border-right: 1px solid #495057; padding-right: 20px;">Панель управления клиники</strong>

        <div style="display: flex; gap: 5px;">
            <a href="{{ route('admin.dashboard') }}" style="color: #f8f9fa; text-decoration: none; padding: 8px 12px; font-size: 14px; border-radius: 4px;" onmouseover="this.style.backgroundColor='#495057'" onmouseout="this.style.backgroundColor='transparent'">Главная админки</a>
            <a href="{{ route('admin.pets.index') }}" style="color: #f8f9fa; text-decoration: none; padding: 8px 12px; font-size: 14px; border-radius: 4px;" onmouseover="this.style.backgroundColor='#495057'" onmouseout="this.style.backgroundColor='transparent'">Питомцы</a>
            <a href="{{ route('admin.owners.index') }}" style="color: #f8f9fa; text-decoration: none; padding: 8px 12px; font-size: 14px; border-radius: 4px;" onmouseover="this.style.backgroundColor='#495057'" onmouseout="this.style.backgroundColor='transparent'">Владельцы</a>
            <a href="{{ route('welcom') }}" style="color: #007bff; text-decoration: none; padding: 8px 12px; font-size: 14px; border-radius: 4px; font-weight: bold;" onmouseover="this.style.backgroundColor='#495057'" onmouseout="this.style.backgroundColor='transparent'">Посмотреть сайт</a>
        </div>
    </div>
    <div style="display: flex; align-items: center; gap: 15px;">
        <span style="font-size: 14px;">Вы вошли как: <strong>{{ Auth::user()->name }}</strong> (Роль: <em>{{ Auth::user()->role }}</em>)</span>
        
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 14px; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#bd2130'" onmouseout="this.style.backgroundColor='#dc3545'">
                Выйти
            </button>
        </form>
    </div>

</header>




    <main class="content">
        @if (session('success')) <x-alert type="success">{{ session('success') }}</x-alert> @endif
        @if (session('error')) <x-alert type="error">{{ session('error') }}</x-alert> @endif

        @yield('content')
    </main>

    @include('partials.footer')
</body>
</html>
