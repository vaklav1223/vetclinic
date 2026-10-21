@extends('layouts.app')

@section('content')
    <h2>Здравствуйте, {{ $booking->user->name }}!</h2>
    <p>Вы успешно оставили заявку на запись в ветеринарную клинику.</p>
    
    <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 20px 0;">
        <p><strong>Данные записи:</strong> {{ $booking->comment }}</p>
        <p><strong>Контактный телефон:</strong> {{ $booking->phone }}</p>
    </div>

    <p>Вы можете отслеживать статус вашей записи в личном кабинете:</p>
    <p>
        <a href="{{ route('profile') }}" style="display: inline-block; padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 4px; font-weight: bold;">
            Перейти в Личный кабинет
        </a>
    </p>
@endsection

