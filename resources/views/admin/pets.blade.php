@extends('layouts.admin')

@section('title', 'Управление питомцами')

@section('content')
    <h1>Список питомцев (Администрирование)</h1>

    <x-card>
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th>#</th>
                    <th>Кличка</th>
                    <th>Порода</th>
                    <th>Статус</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $id => $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item['title'] ?? "Питомец №$id" }}</td>
                        <td>{{ $item['breed'] ?? '-' }}</td>
                        <td>
                            @if($loop->first)
                                <x-badge style="background-color: #dc3545;">новая</x-badge>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center;">Нет данных для отображения</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-card>
@endsection
