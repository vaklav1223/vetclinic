@extends('layouts.app')

@section('title', 'Правила')

@section('content')
    <h1>Правила</h1>
    
    <x-card>
        <p><strong>правило №1:</strong> {{ $prav }}</p>
    </x-card>
@endsection
