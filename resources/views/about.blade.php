@extends('layouts.app')

@section('title', 'О проекте - ' . config('app.name'))

@section('content')
    <h1>О проекте</h1>
    
    <x-card>
        <p><strong>Студент:</strong> {{ $fio }} (Группа: {{ $group }})</p>
        <p><strong>Описание:</strong> {{ $description }}</p>
    </x-card>
@endsection
