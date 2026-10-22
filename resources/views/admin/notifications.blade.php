@extends('layouts.admin')

@section('content')
<div style="max-width: 1200px; margin: 20px auto; padding: 0 15px; font-family: sans-serif;">
    <h2 style="margin-bottom: 20px;">🔔 Уведомления администратора</h2>

    @if(auth()->user()->unreadNotifications->count() > 0)
        <form action="{{ route('admin.notifications.markAsRead') }}" method="POST" style="margin-bottom: 20px;">
            @csrf
            <button type="submit" style="background: #007bff; color: white; border: none; padding: 10px 15px; border-radius: 4px; font-weight: bold; cursor: pointer;">
                ✓ Отметить всё прочитанным
            </button>
        </form>
    @else
        <p style="color: #6c757d; font-size: 16px;">Новых уведомлений нет.</p>
    @endif

    <div style="background: #fff; border: 1px solid #dee2e6; border-radius: 6px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <ul style="list-style: none; padding: 0; margin: 0;">
            @foreach($notifications as $n)
                <li style="padding: 15px 20px; border-bottom: 1px solid #dee2e6; display: flex; justify-content: space-between; align-items: center; background: {{ $n->read_at ? '#fff' : '#f8f9fa' }};">
                    
                    <span style="{{ $n->read_at ? 'color: #6c757d;' : 'font-weight: bold; color: #212529;' }}">

                        @if(isset($n->data['url']))
                            <a href="{{ $n->data['url'] }}" style="color: #007bff; text-decoration: underline; font-weight: bold;">
                                {{ $n->data['message'] ?? 'PDF-каталог готов' }} (Нажмите, чтобы скачать)
                            </a>
                        @else
                        @endif
                    </span>
                    
                    <small style="color: #6c757d;">{{ $n->created_at->diffForHumans() }}</small>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
