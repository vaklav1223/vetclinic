@extends('layouts.admin')

@section('title', 'Редактировать владельца')

@section('content')
<div class="content" style="max-width: 600px; margin: 0 auto; padding: 20px;">
    <h2>Редактирование владельца: {{ $owner->name }}</h2>
    <a href="{{ route('admin.owners.index') }}" style="display: inline-block; margin-bottom: 15px;">← Вернуться к списку</a>

    <form method="POST" action="{{ route('admin.owners.update', $owner->id) }}" style="background: #fff; padding: 20px; border: 1px solid #dee2e6; border-radius: 8px;">
        @csrf
        @method('PUT')
        <div style="margin-bottom: 15px;">
            <label for="name" style="display: block; margin-bottom: 5px;"><strong>ФИО Владельца:</strong></label>
            <input type="text" id="name" name="name" value="{{ old('name', $owner->name) }}" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            @error('name') <span style="color: #dc3545; font-size: 14px; display: block; margin-top: 5px;">{{ $message }}</span> @enderror
        </div>
        <div style="margin-bottom: 15px;">
            <label for="phone" style="display: block; margin-bottom: 5px;"><strong>Телефон:</strong></label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $owner->phone) }}" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            @error('phone') <span style="color: #dc3545; font-size: 14px; display: block; margin-top: 5px;">{{ $message }}</span> @enderror
        </div>
        <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: #fff; border: none; cursor: pointer; border-radius: 4px; font-weight: bold;">Сохранить</button>
    </form>
</div>
@endsection
