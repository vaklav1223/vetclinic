@extends('layouts.admin')

@section('title', 'Редактировать питомца')

@section('content')
<div class="content" style="max-width: 600px; margin: 0 auto; padding: 20px;">
    <h2>Редактирование питомца: {{ $pet->title }}</h2>
    
    <a href="{{ route('admin.pets.index') }}" style="display: inline-block; margin-bottom: 15px;">← Вернуться к списку</a>

    <form method="POST" action="{{ route('admin.pets.update', $pet) }}" enctype="multipart/form-data" style="background: #fff; padding: 20px; border: 1px solid #dee2e6; border-radius: 8px;">

        @method('PUT')
        @include('admin.pets._form')
    </form>
</div>
@endsection
