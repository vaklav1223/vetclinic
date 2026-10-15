@extends('layouts.app')

@section('title', 'Питомец №' . $id)

@section('content')
    <h1>Кличка питомца: {{ $book['title'] }}</h1>
    
    <div class="card">
        <ul>
            @foreach($book as $key => $value)
                @if($key !== 'title')
                    <li><strong>{{ $key }}:</strong> {{ $value }}</li>
                @endif
            @endforeach
        </ul>
    </div>
    
    <p>
        <a href="{{ route('welcom') }}">← На главную</a>
    </p>
@endsection
