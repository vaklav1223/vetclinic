@extends('layouts.app')

@section('content')
<div style="max-width: 1200px; margin: 20px auto; padding: 0 15px; font-family: sans-serif;">
    <h2>Личный кабинет: Мои заявки</h2>
    @if(auth()->user()->unreadNotifications->isNotEmpty())
        <div style="background: #e2f0fe; border-left: 4px solid #007bff; padding: 15px; border-radius: 4px; margin-bottom: 25px;">
            <h4 style="margin-top: 0; margin-bottom: 10px; color: #004085;">🔔 Новые уведомления от клиники:</h4>
            <ul style="margin: 0; padding-left: 20px;">
                @foreach(auth()->user()->unreadNotifications as $notification)
                    <li style="margin-bottom: 5px; color: #004085;">
                        {{ $notification->data['message'] ?? 'Статус заявки изменен' }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div style="padding: 15px; background: #d4edda; color: #155724; border-radius: 4px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    @if($bookings->isEmpty())
        <p>Вы еще не оставляли заявок на запись.</p>
    @else
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                    <th style="padding: 12px; text-align: left;">Информация о записи</th>
                    <th style="padding: 12px; text-align: left;">Контакты</th>
                    <th style="padding: 12px; text-align: left;">Дата создания</th>
                    <th style="padding: 12px; text-align: left;">Статус</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr style="border-bottom: 1px solid #dee2e6;">
                        <td style="padding: 12px;">{{ $booking->comment }}</td>
                        <td style="padding: 12px;">{{ $booking->phone }}</td>
                        <td style="padding: 12px;">{{ $booking->created_at->format('d.m.Y H:i') }}</td>
                        <td style="padding: 12px;">
                            <span style="padding: 5px 10px; background: {{ $booking->status === 'new' ? '#ffc107' : ($booking->status === 'processed' ? '#28a745' : '#dc3545') }}; color: {{ $booking->status === 'new' ? '#000' : '#fff' }}; border-radius: 12px; font-size: 14px;">
                                {{ $booking->status }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
