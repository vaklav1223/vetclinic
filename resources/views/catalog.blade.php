@extends('layouts.app')

@section('title', 'Каталог питомцев')

@section('content')
    <h1>Каталог наших питомцев</h1>

    <div class="owners-sidebar" style="margin-bottom: 30px; padding: 15px; background: #f8f9fa; border-radius: 8px;">
        <h3>Наши владельцы:</h3>
        <ul style="list-style: none; padding-left: 0; display: flex; gap: 15px; flex-wrap: wrap;">
            @foreach($ownersForMenu as $menuOwner)
                <li>
                    <a href="{{ route('owners.show', $menuOwner->id) }}">
                        {{ $menuOwner->name }} ({{ $menuOwner->pets_count }})
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <form method="GET" action="{{ route('pets.index') }}" style="margin-bottom: 20px; padding: 15px; background: #f8f9fa; border-radius: 8px;">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Поиск питомца...">

        <select name="owner">
            <option value="">Все владельцы</option>
            @foreach($ownersForMenu as $menuOwner)
                <option value="{{ $menuOwner->id }}" @selected(request('owner') == $menuOwner->id)>
                    {{ $menuOwner->name }}
                </option>
            @endforeach
        </select>

        <select name="sort">
            <option value="latest" @selected(request('sort') == 'latest' || !request('sort'))>Сначала новые</option>
            <option value="price_asc" @selected(request('sort') == 'price_asc')>Цена: по возрастанию</option>
            <option value="price_desc" @selected(request('sort') == 'price_desc')>Цена: по убыванию</option>
        </select>

        <button type="submit">Найти</button>
        <a href="{{ route('pets.index') }}" style="margin-left: 10px;">Сбросить</a>
    </form>

    @forelse($items as $item)
        <x-card style="margin-bottom: 15px;">
            <h3>
                <a href="{{ route('pets.show', $item->id) }}">
                    Питомец: {{ $item->title ?? "№$item->id" }}
                </a>
            </h3>
            
            @if(!empty($item->breed))
                <p>Порода: {{ $item->breed }}</p>
            @endif
            
            @if($item->owner)
                <p><strong>Владелец:</strong> {{ $item->owner->name }}</p>
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
        @if(request('q'))
            <x-alert type="warning">По запросу «{{ request('q') }}» ничего не найдено.</x-alert>
        @else
            <x-alert type="info">В каталоге пока нет питомцев.</x-alert>
        @endif
    @endforelse
    <div class="my-pagination">
        {{ $items->links() }}
    </div>



@endsection
