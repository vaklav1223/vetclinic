<nav>
    <a href="{{ route('welcom') }}" class="{{ request()->routeIs('welcom') ? 'active' : '' }}">Главная</a> 
    <a href="{{ route('pets.index') }}" class="{{ request()->routeIs('pets.index') || request()->routeIs('pets.show') ? 'active' : '' }}">Каталог</a>
    <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">О проекте</a>
    <a href="{{ route('contacts') }}" class="{{ request()->routeIs('contacts') ? 'active' : '' }}">Контакты</a>
    <a href="{{ route('prav') }}" class="{{ request()->routeIs('prav') ? 'active' : '' }}">Правила</a>
    <a href="{{ route('booking') }}" class="{{ request()->routeIs('booking') ? 'active' : '' }}">Запись</a>
</nav>
