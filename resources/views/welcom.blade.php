@extends('layouts.app')

@section('title', config('app.name'))

@section('content')
    <h1>{{ config('app.name') }}</h1>
    
    <x-card>
        <p>Сегодня: {{ now()->format('d.m.Y') }}</p>
    </x-card>
@endsection
