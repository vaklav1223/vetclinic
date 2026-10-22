<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>PDF Каталог</title>
    <style>
        body { font-family: "DejaVu Sans", sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Тестовый каталог питомцев (Без картинок)</h2>
    <table>
        <thead>
            <tr>
                <th>№</th>
                <th>Кличка</th>
                <th>Порода</th>
                <th>Цена за день</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->title ?? '—' }}</td>
                    <td>{{ $item->breed ?? '—' }}</td>
                    <td>{{ $item->price }} руб.</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
