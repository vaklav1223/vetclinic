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
        <a href="{{ route('pets.index') }}" style="margin-left: 10px; margin-right: 15px;">Сбросить</a>

        <!-- КНОПКА СКАЧИВАНИЯ PDF-КАТАЛОГА (Пункт 4) -->
        <a href="{{ route('pets.pdf', request()->query()) }}" style="display: inline-block; padding: 6px 12px; background-color: #dc3545; color: #fff; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 14px; vertical-align: middle;">
            📄 Скачать PDF
        </a>
    </form>

    <div style="display: flex; flex-direction: column; gap: 20px;">
        @forelse($items as $item)
            <!-- Сама карточка занимает всю ширину -->
            <x-card style="margin-bottom: 0; padding: 15px; border: 1px solid #dee2e6; border-radius: 8px; background: #fff;">
                <!-- Внутри выстраиваем контент в строку (картинка слева, текст справа) -->
                <div style="display: flex; gap: 20px; align-items: center; flex-wrap: wrap;">
                    
                    <!-- Блок с картинкой фиксированного размера -->
                    <div style="width: 150px; height: 150px; flex-shrink: 0; background: #f8f9fa; display: flex; align-items: center; justify-content: center; border-radius: 6px; overflow: hidden; border: 1px solid #eee;">
                        <img src="{{ $item->cover_url }}" alt="{{ $item->title }}" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                    </div>
                    
                    <!-- Блок с описанием питомца -->
                    <div style="flex: 1; min-width: 250px;">
                        <h3 style="margin-top: 0; margin-bottom: 10px;">
                            <a href="{{ route('pets.show', $item->id) }}" style="color: #4b0082; text-decoration: none; font-weight: bold;">
                                Питомец: {{ $item->title ?? "№$item->id" }}
                            </a>
                        </h3>
                        
                        @if(!empty($item->breed))
                            <p style="margin: 5px 0;"><strong>Порода:</strong> {{ $item->breed }}</p>
                        @endif
                        
                        @if($item->owner)
                            <p style="margin: 5px 0;"><strong>Владелец:</strong> {{ $item->owner->name }}</p>
                        @endif
                        
                        @if(isset($item->age))
                            <p style="margin: 5px 0;"><strong>Возраст:</strong> {{ $item->age }}</p>
                            @if((int)$item->age > 5)
                                <x-badge style="background-color: #ffc107; color: #000;">Опытный</x-badge>
                            @endif
                        @endif
                        
                        <div style="margin-top: 10px;">
                            <x-badge>Каталог</x-badge>
                        </div>
                    </div>

                </div>
            </x-card>
        @empty
            @if(request('q'))
                <x-alert type="warning">По запросу «{{ request('q') }}» ничего не найдено.</x-alert>
            @else
                <x-alert type="info">В каталоге пока нет питомцев.</x-alert>
            @endif
        @endforelse
    </div>

    <div class="my-pagination" style="margin-top: 20px;">
        {{ $items->links() }}
    </div>
@endsection
