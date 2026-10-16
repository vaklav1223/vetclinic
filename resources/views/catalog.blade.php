@extends('layouts.app')

@section('title', 'Каталог питомцев')

@section('content')
    <h1>Каталог наших питомцев</h1>

    @forelse($items as $item)
        <x-card>
            <h3>
                <a href="{{ route('pets.show', $item->id) }}">
                    Питомец: {{ $item->title ?? "№$item->id" }}
                </a>
            </h3>
            
            @if(!empty($item->breed))
                <p>Порода: {{ $item->breed }}</p>
            @endif
            
            {{-- Вывод связанной записи (Владелец) из join --}}
            @if(!empty($item->owner_name))
                <p><strong>Владелец:</strong> {{ $item->owner_name }}</p>
            @endif
            
            @if(isset($item->age))
                <p>Возраст: {{ $item->age }}</p>
                @if((int)$item->age > 5)
                    <x-badge style="background-color: #ffc107; color: #000;">Опытный</x-badge>
                @endif
            @endif
            
            <x-badge>Каталог</x-badge>
        </x-card>
    @empty
        <x-alert type="info">
            В каталоге пока нет питомцев.
        </x-alert>
    @endforelse
@endsection
