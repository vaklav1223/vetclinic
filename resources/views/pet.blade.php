@extends('layouts.app')

@section('title', 'Питомец: ' . $pet->title)

@section('content')
<div style="max-width: 1200px; margin: 20px auto; padding: 0 15px;">
    
    <h1 style="margin-bottom: 25px; font-size: 28px;">Кличка питомца: {{ $pet->title }}</h1>

    <x-card style="padding: 25px; border: 1px solid #dee2e6; border-radius: 8px; background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <div style="display: flex; gap: 40px; align-items: flex-start; flex-wrap: wrap;">
            <div style="width: 360px; max-width: 100%; background: #f8f9fa; border: 1px solid #eee; border-radius: 8px; overflow: hidden; padding: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <img src="{{ $pet->cover_url }}" alt="{{ $pet->title }}" style="width: 100%; height: auto; max-height: 450px; object-fit: contain; border-radius: 6px;">
            </div>
            <div style="flex: 1; min-width: 280px; padding-top: 10px;">
                <ul style="padding-left: 0; list-style-type: none; line-height: 2; font-size: 18px; color: #333;">
                    @if($pet->breed)
                        <li style="margin-bottom: 8px;"><strong>Порода:</strong> {{ $pet->breed }}</li>
                    @endif

                    <li style="margin-bottom: 8px;"><strong>Возраст:</strong> {{ $pet->age }}</li>
                    <li style="margin-bottom: 8px;"><strong>Цена за день:</strong> {{ number_format($pet->price, 2, '.', ' ') }} руб.</li>
                    <li style="margin-bottom: 8px;"><strong>Вакцинация:</strong> {{ $pet->is_vaccinated ? 'Да' : 'Нет' }}</li>

                    @if($pet->birth_date)
                        <li style="margin-bottom: 8px;"><strong>Дата рождения:</strong> {{ $pet->birth_date->format('d.m.Y') }}</li>
                    @endif

                    @if($pet->rating)
                        <li style="margin-bottom: 8px;"><strong>Рейтинг:</strong> {{ $pet->rating }}</li>
                    @endif

                    <li style="margin-bottom: 8px;">
                        <strong>Владелец:</strong> 
                        <a href="/owners/{{ $pet->owner->id }}" style="color: #4b0082; font-weight: bold; text-decoration: none; border-bottom: 1px dashed #4b0082;">{{ $pet->owner->name }}</a>
                    </li>
                    @auth
                        @if($pet->attachment)
                            <li style="margin-top: 25px;">
                                <a href="{{ route('pets.attachment.download', $pet->id) }}" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 15px; box-shadow: 0 2px 4px rgba(0,123,255,0.3);">
                                    📥 Скачать документ
                                </a>
                            </li>
                        @endif
                    @endauth

                    <li style="margin-top: 25px; list-style-type: none;">
                        <div style="padding: 15px; border: 1px dashed #ccc; border-radius: 8px; background: #fafafa; display: inline-block;">
                            <h4 style="margin-top: 0; margin-bottom: 10px; font-size: 14px; color: #555;">QR-код ссылки на питомца:</h4>
                            {!! QrCode::size(120)->generate(request()->url()) !!}
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </x-card>

    @if($otherPets->isNotEmpty())
        <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #eee;">
            <h3 style="margin-bottom: 15px; font-size: 22px;">Ещё от этого владельца:</h3>
            <ul style="line-height: 1.8; font-size: 16px;">
                @foreach($otherPets as $otherPet)
                    <li>
                        <a href="{{ route('pets.show', $otherPet->id) }}" style="color: #007bff; text-decoration: none;">{{ $otherPet->title }}</a>
                        @if($otherPet->breed)
                            <span style="color: #666;">({{ $otherPet->breed }})</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <p style="margin-top: 30px;">
        <a href="{{ route('pets.index') }}" style="color: #6c757d; text-decoration: none; font-weight: bold;">← Вернуться в каталог</a>
    </p>
</div>
@endsection
