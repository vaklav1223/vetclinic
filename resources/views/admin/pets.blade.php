@extends('layouts.admin')

@section('title', 'Управление питомцами')

@section('content')
<style>
    .admin-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
        margin-bottom: 20px;
        background-color: #fff;
    }

    .admin-table th, 
    .admin-table td {
        border: 1px solid #dee2e6;
        padding: 12px 15px;
        text-align: left;
    }

    .admin-table th {
        background-color: #f8f9fa;
        font-weight: bold;
    }

    .admin-table tbody tr:nth-child(even) {
        background-color: #fdfdfd;
    }

    .admin-table tbody tr:hover {
        background-color: #f1f3f5;
    }
</style>

<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Список питомцев</h2>
        @can('create', App\Models\Pet::class)
            <a href="{{ route('admin.pets.create') }}" class="btn btn-primary">Добавить питомца</a>
        @endcan
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th style="width: 15%;">ID / Кличка</th>
                <th>Владелец</th>
                <th>Автор записи</th>
                <th style="width: 20%;">Дата создания</th>
                <th style="width: 20%;">Действия</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pets as $pet)
                <tr>
                    <td><strong>#{{ $pet->id }}</strong> — {{ $pet->title }}</td>
                    <td>{{ $pet->owner->name ?? 'Не указан' }}</td>
                    
                    <td>{{ $pet->user->name ?? 'Система' }}</td>
                    
                    <td>{{ $pet->created_at->format('d.m.Y') }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            @can('update', $pet)
                                <a href="{{ route('admin.pets.edit', $pet) }}" class="btn btn-sm btn-warning">Изменить</a>
                            @endcan
                            @can('delete', $pet)
                                <form method="POST" action="{{ route('admin.pets.destroy', $pet) }}" onsubmit="return confirm('Удалить запись?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Удалить</button>
                                </form>
                            @endcan
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Питомцев пока нет.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="my-pagination">
        {{ $pets->links() }}
    </div>
</div>
@endsection
