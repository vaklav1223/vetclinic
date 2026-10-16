@extends('layouts.admin')

@section('title', 'Добавить запись')

@section('content')
    <h1>Форма добавления записи</h1>
    
    <p><a href="{{ route('admin.dashboard') }}">← В панель администратора</a></p>
    
    <x-card>
        <form action="#" method="GET">
            <p><label>Кличка: <input type="text" name="title" required></label></p>
            <p><label>Порода: <input type="text" name="breed"></label></p>
            <p><label>Возраст: <input type="number" name="age"></label></p>
            <button type="button">Сохранить (Пока не работает)</button>
        </form>
    </x-card>
@endsection
