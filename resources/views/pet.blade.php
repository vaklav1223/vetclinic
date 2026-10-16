@extends('layouts.app')

@section('title', 'Питомец №' . $id)

@section('content')
    {{-- Берем кличку из объекта $book --}}
    <h1>Кличка питомца: {{ $book->title ?? "№$id" }}</h1>

    <x-card>
        <ul>
            @foreach((array)$book as $key => $value)
                @if(!in_array($key, ['title', 'id', 'owner_id', 'created_at', 'updated_at']) && !empty($value))
                    <li>
                        <strong>
                            {{-- Заменяем неверный @match на валидный @switch --}}
                            @switch($key)
                                @case('breed') Порода @break
                                @case('age') Возраст @break
                                @case('price') Цена за день @break
                                @case('is_vaccinated') Вакцинация @break
                                @case('birth_date') Дата рождения @break
                                @case('rating') Рейтинг @break
                                @case('owner_name') Владелец @break
                                @default {{ $key }}
                            @endswitch:
                        </strong> 
                        {{ $key === 'is_vaccinated' ? ($value ? 'Да' : 'Нет') : $value }}
                    </li>
                @endif
            @endforeach
        </ul>
    </x-card>

    <p style="margin-top: 20px;">
        <a href="{{ route('pets.index') }}">← Назад в каталог</a>
    </p>
@endsection
