@extends('layouts.app')

@section('title', 'Каталог питомцев')

@section('content')
    <h1>Каталог наших питомцев</h1>

    @forelse($items as $id => $item)
        <div class="card">
            <h3>
                {{ $loop->iteration }}. 
                <a href="{{ route('pets.show', $id) }}">
                    Питомец: {{ $item['title'] ?? "№$id" }}
                </a>
            </h3>
            @if(isset($item['breed']))
                <p>Порода: {{ $item['breed'] }}</p>
            @endif
            @if(isset($item['age']))
                <p>Возраст: {{ $item['age'] }}</p>
                @if((int)$item['age'] > 5)
                    <span class="badge" style="background-color: #ffc107; color: #000;">Опытный</span>
                @endif
            @endif
            <span class="badge">Каталог</span>
        </div>
    @empty
        <div class="card">
            <p>В каталоге пока нет питомцев.</p>
        </div>
    @endforelse
@endsection
