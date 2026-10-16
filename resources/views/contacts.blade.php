@extends('layouts.app')

@section('title', 'Контакты - ' . config('app.name'))

@section('content')
    <h1>Контакты организации</h1>
    
    <x-card>
        <p><strong>Адрес:</strong> {{ $address }}</p>
        <p><strong>Телефон:</strong> {{ $phone }}</p>
        <p><strong>Email:</strong> {{ $email }}</p>
    </x-card>
@endsection
