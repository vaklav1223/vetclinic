@extends('layouts.app')

@section('title', 'Запись на приём')

@section('content')
    <h1>Записаться на приём в клинику</h1>
    
    <x-card>
        @auth
            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf

                @error('pet_id')
                    <p style="color: red; font-weight: bold;">{{ $message }}</p>
                @enderror

                <p>
                    <label style="display: block; margin-bottom: 5px;">Кличка питомца:</label>
                    <input type="text" name="pet_name" value="{{ old('pet_name', '') }}" required style="width: 100%; max-width: 300px; padding: 5px;">
                </p>

                <p>
                    <label style="display: block; margin-bottom: 5px;">Порода питомца:</label>
                    <input type="text" name="pet_breed" value="{{ old('pet_breed', '') }}" required style="width: 100%; max-width: 300px; padding: 5px;">
                </p>

                <p>
                    <label style="display: block; margin-bottom: 5px;">Телефон (Казахстан):</label>
                    <input type="text" name="phone" value="{{ old('phone', '+7') }}" required placeholder="+77XXXXXXXXX" style="width: 100%; max-width: 300px; padding: 5px;">
                    @error('phone')
                        <span style="color: red; display: block; margin-top: 5px;">{{ $message }}</span>
                    @enderror
                </p>

                <p>
                    <label style="display: block; margin-bottom: 5px;">Комментарий:</label>
                    <textarea name="comment" rows="3" style="width: 100%; max-width: 300px; padding: 5px;">{{ old('comment') }}</textarea>
                </p>

                <button type="submit" style="padding: 8px 15px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; margin-top: 10px;">
                    Отправить заявку
                </button>
            </form>
        @else
            <p style="color: #6c757d; font-weight: bold; text-align: center;">
                Войдите, чтобы оставить заявку
            </p>
        @endauth
    </x-card>
@endsection
