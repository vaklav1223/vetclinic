<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>PDF Каталог</title>
    <style>
        body {
            font-family: "DejaVu Sans", sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            margin-bottom: 20px;
            border-bottom: 2px solid #4b0082;
            padding-bottom: 10px;
        }
        .title {
            font-size: 20px;
            color: #4b0082;
        }
        .date {
            float: right;
            font-size: 12px;
            color: #666;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f8f9fa;
        }
        .thumb {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }
        .total {
            font-size: 14px;
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>
<body>

    <div class="header">
        <span class="date">Дата: {{ date('d.m.Y H:i') }}</span>
        <span class="title">Ветеринарная клиника «VETCLINIC»</span>
    </div>

    <h2>Каталог питомцев</h2>

    <table class="table">
        <thead>
            <tr>
                <th>№</th>
                <th>Фото</th>
                <th>Кличка</th>
                <th>Порода</th>
                <th>Владелец</th>
                <th>Возраст</th>
                <th>Цена за день</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        @if($item->cover && file_exists(public_path('storage/' . $item->cover)))
                            <img src="{{ public_path('storage/' . $item->cover) }}" class="thumb" alt="">
                        @else
                            <img src="{{ public_path('images/no-cover.png') }}" class="thumb" alt="">
                        @endif
                    </td>
                    <td>{{ $item->title ?? '—' }}</td>
                    <td>{{ $item->breed ?? '—' }}</td>
                    <td>{{ $item->owner->name ?? '—' }}</td>
                    <td>{{ $item->age ?? '—' }}</td>
                    <td>{{ number_format($item->price, 2, '.', ' ') }} руб.</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        Всего записей: {{ $items->count() }}
    </div>

</body>
</html>
