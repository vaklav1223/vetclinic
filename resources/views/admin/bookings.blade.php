@extends('layouts.admin')

@section('title', 'Управление заявками')

@section('content')
<div style="max-width: 1200px; margin: 20px auto; padding: 0 15px; font-family: sans-serif;">
    <h2 style="margin-bottom: 20px;">📋 Панель администратора: Управление заявками</h2>

    @if(session('success'))
        <div style="padding: 15px; background: #d4edda; color: #155724; border-radius: 4px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <table style="width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <thead>
            <tr style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                <th style="padding: 12px; text-align: left;">Клиент</th>
                <th style="padding: 12px; text-align: left;">Данные заявки</th>
                <th style="padding: 12px; text-align: left;">Телефон</th>
                <th style="padding: 12px; text-align: left;">Дата</th>
                <th style="padding: 12px; text-align: left;">Статус</th>
                <th style="padding: 12px; text-align: left;">Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $b)
                <tr style="border-bottom: 1px solid #dee2e6;">
                    <td style="padding: 12px;">{{ $b->user->name }}</td>
                    <td style="padding: 12px;">{{ $b->comment }}</td>
                    <td style="padding: 12px;">{{ $b->phone }}</td>
                    <td style="padding: 12px;">{{ $b->created_at->format('d.m.Y H:i') }}</td>
                    <td style="padding: 12px;">
                        <span style="padding: 4px 8px; border-radius: 4px; font-size: 14px; background: {{ $b->status === 'new' ? '#ffc107' : ($b->status === 'processed' ? '#28a745' : '#dc3545') }}; color: {{ $b->status === 'new' ? '#000' : '#fff' }};">
                            {{ $b->status }}
                        </span>
                    </td>
                    <td style="padding: 12px;">
                        @if($b->status === 'new')
                            <form action="{{ route('admin.bookings.status.update', $b->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="processed">
                                <button type="submit" style="background: #28a745; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-weight: bold; margin-right: 5px;">Принять</button>
                            </form>
                            <form action="{{ route('admin.bookings.status.update', $b->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" style="background: #dc3545; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-weight: bold;">Отклонить</button>
                            </form>
                        @else
                            <span style="color: #6c757d; font-size: 14px;">Обработано</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
