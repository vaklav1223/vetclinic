@extends('layouts.app')

@section('title', 'Запись на приём')

@section('content')
    <h1>Записаться на приём в клинику</h1>
    
    <div class="card">
        <form action="#" method="GET">
            <p><label>Имя владельца: <input type="text" required></label></p>
            <p><label>Кличка питомца: <input type="text" required></label></p>
            <button type="button">Отправить заявку</button>
        </form>
    </div>
@endsection
