@extends('layouts.app')

@section('title', 'Владелец: ' . $owner->name)

@section('content')
    <h1>Владелец: {{ $owner->name }}</h1>

    <x-card>
        <p><strong>Описание:</strong> {{ $owner->description ?? 'Нет описания' }}</p>
        <p><strong>Телефон:</strong> {{ $owner->phone }}</p>
    </x-card>

    <h3 style="margin-top: 30px;">Питомцы этого владельца:</h3>
    
    @forelse($owner->pets as $pet)
        <x-card>
            <h4>
                <a href="{{ route('pets.show', $pet->id) }}">{{ $pet->title }}</a>
            </h4>
            <p>Порода: {{ $pet->breed ?? 'Не указана' }}</p>
            <p>Возраст: {{ $pet->age }}</p>
        </x-card>
    @empty
        <p>У этого владельца пока нет зарегистрированных питомцев.</p>
    @endforelse

    <p style="margin-top: 20px;">
        <a href="{{ route('pets.index') }}">← Назад в каталог</a>
    </p>
@endsection
