@extends('layouts.admin')

@section('title', 'Управление владельцами')

@section('content')
<div class="content" style="padding: 20px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Список владельцев</h2>
        @can('create', App\Models\Owner::class)
            <a href="{{ route('admin.owners.create') }}" style="padding: 8px 15px; background: #007bff; color: #fff; text-decoration: none; border-radius: 4px; font-weight: bold;">Добавить владельца</a>
        @endcan
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th style="width: 10%;">ID</th>
                <th>ФИО Владельца</th>
                <th style="width: 20%;">Количество питомцев</th>
                <th style="width: 20%;">Автор записи</th>
                <th style="width: 20%;">Действия</th>
            </tr>
        </thead>
        <tbody>
            @forelse($owners as $owner)
                <tr>
                    <td><strong>#{{ $owner->id }}</strong></td>
                    <td>{{ $owner->name }}</td>
                    <td>{{ $owner->pets_count }}</td>
                    
                    <td>
                      @if($owner->user)
                      {{ $owner->user->name }} 
                      <span style="font-size: 11px; color: #6c757d; background: #e9ecef; padding: 2px 6px; border-radius: 3px;">
                       {{ $owner->user->role }}
                         </span>
                     @else
                      Система
                      @endif
                    </td>

                    
                    <td>
                        <div style="display: flex; gap: 5px;">
                            @can('update', $owner)
                                <a href="{{ route('admin.owners.edit', $owner) }}" style="padding: 2px 5px; background: #ffc107; border: 1px solid #d39e00; text-decoration: none; color: #000; font-size: 13px; border-radius: 3px;">Изменить</a>
                            @endcan
                            
                            @can('delete', $owner)
                                <form method="POST" action="{{ route('admin.owners.destroy', $owner) }}" onsubmit="return confirm('Удалить владельца?')" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="padding: 2px 5px; background: #dc3545; border: 1px solid #bd2130; color: #fff; font-size: 13px; border-radius: 3px; cursor: pointer;">Удалить</button>
                                </form>
                            @endcan
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Владельцев пока нет.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="my-pagination">
        {{ $owners->links() }}
    </div>
</div>

<style>
    .admin-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
        margin-bottom: 20px;
        background-color: #fff;
    }
    .admin-table th, .admin-table td {
        border: 1px solid #dee2e6;
        padding: 12px 15px;
        text-align: left;
    }
    .admin-table th {
        background-color: #f8f9fa;
        font-weight: bold;
    }
    .admin-table tbody tr:hover {
        background-color: #f1f3f5;
    }
</style>
@endsection

