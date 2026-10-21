@extends('layouts.admin')

@section('title', 'Панель администратора')

@section('content')
    <h1>Панель администратора</h1>
    
    <x-card>
        <p>Добро пожаловать в панель управления ветеринарной клиникой. Используйте меню навигации в шапке для перехода к нужным разделам.</p>
        <p>
            <a href="{{ route('admin.pets.index') }}">Управление питомцами (Таблица)</a> | 
            <a href="{{ route('admin.pets.create') }}">Добавить питомца (Форма)</a> | 
            <a href="{{ route('admin.owners.index') }}">Управление владельцами</a> | 
            <a href="{{ route('welcom') }}">Выйти на сайт</a>
        </p>
    </x-card>
@endsection
