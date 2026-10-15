@extends('layouts.app')

@section('title', 'Правила')

@section('content')
    <h1>Правила</h1>
    
    <div class="card">
        <p><strong>правило №1:</strong> {{ $prav }}</p>
    </div>
@endsection
