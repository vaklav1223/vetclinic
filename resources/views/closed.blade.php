@extends('layouts.app')

@section('title', 'Клиника закрыта')

@section('content')
    <h1 style="color: red;">Сейчас закрыто</h1>
    
    <x-card>
        <h2>Работаем с {{ $from }} до {{ $to }}</h2>
        <p><a href="{{ route('welcom') }}">На главную</a></p>
    </x-card>
@endsection
