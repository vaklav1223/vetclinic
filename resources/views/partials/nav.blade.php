<nav style="display: flex; justify-content: space-between; align-items: center; background-color: #343a40; padding: 0 20px;">
    <div style="display: flex; align-items: center;">
        <a href="{{ route('welcom') }}" class="{{ request()->routeIs('welcom') ? 'active' : '' }}">Главная</a> 
        <a href="{{ route('pets.index') }}" class="{{ request()->routeIs('pets.index') || request()->routeIs('pets.show') ? 'active' : '' }}">Каталог</a>
        <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">О проекте</a>
        <a href="{{ route('contacts') }}" class="{{ request()->routeIs('contacts') ? 'active' : '' }}">Контакты</a>
        <a href="{{ route('prav') }}" class="{{ request()->routeIs('prav') ? 'active' : '' }}">Правила</a>
        <a href="{{ route('booking') }}" class="{{ request()->routeIs('booking') ? 'active' : '' }}">Запись</a>
        <a href="{{ route('profile') }}" style="display: inline-block; background-color: #6c757d; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-weight: bold; margin-left: 10px;">
            Личный кабинет
        </a>
    </div>
    <div style="display: flex; align-items: center; gap: 10px;">
        @guest
            <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">Вход</a>
            <a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'active' : '' }}">Регистрация</a>
        @endguest

        @auth
            <span style="color: #fff; font-family: sans-serif; font-size: 14px; margin-right: 10px;">Привет, {{ Auth::user()->name }}</span>

            @can('admin-panel')
                <a href="/admin" class="{{ request()->is('admin*') ? 'active' : '' }}">Админ-панель</a>
            @endcan

            <form action="{{ route('logout') }}" method="POST" style="display: inline; margin: 0;">
                @csrf
                <button type="submit" class="nav-logout-btn">Выйти</button>
            </form>
        @endauth
    </div>

</nav>
