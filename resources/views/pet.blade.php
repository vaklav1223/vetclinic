@extends('layouts.app')

@section('title', 'Питомец: ' . $pet->title)

@section('content')
    <h1>Кличка питомца: {{ $pet->title }}</h1>

    <x-card>
        <ul>
            @if($pet->breed)
                <li><strong>Порода:</strong> {{ $pet->breed }}</li>
            @endif

            <li><strong>Возраст:</strong> {{ $pet->age }}</li>
            <li><strong>Цена за день:</strong> {{ $pet->price }}</li>
            <li><strong>Вакцинация:</strong> {{ $pet->is_vaccinated ? 'Да' : 'Нет' }}</li>

            @if($pet->birth_date)
                <li><strong>Дата рождения:</strong> {{ $pet->birth_date->format('d.m.Y') }}</li>
            @endif

            @if($pet->rating)
                <li><strong>Рейтинг:</strong> {{ $pet->rating }}</li>
            @endif

            <li>
                <strong>Владелец:</strong> 
                <a href="/owners/{{ $pet->owner->id }}">{{ $pet->owner->name }}</a>
            </li>
        </ul>
    </x-card>

    @if($otherPets->isNotEmpty())
        <div style="margin-top: 30px;">
            <h3>Ещё от этого владельца:</h3>
            <ul>
                @foreach($otherPets as $otherPet)
                    <li>
                        <a href="{{ route('pets.show', $otherPet->id) }}">{{ $otherPet->title }}</a>
                        @if($otherPet->breed)
                            ({{ $otherPet->breed }})
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    @endif


    <p style="margin-top: 20px;">
        <a href="{{ route('pets.index') }}">← Назад в каталог</a>
    </p>
@endsection
