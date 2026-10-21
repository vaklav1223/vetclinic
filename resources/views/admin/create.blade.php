@extends('layouts.admin')

@section('title', 'Добавить питомца')

@section('content')
<div class="content" style="max-width: 600px; margin: 0 auto; padding: 20px;">
    <h2>Добавление нового питомца</h2>
    
    <a href="{{ route('admin.pets.index') }}" style="display: inline-block; margin-bottom: 1fa5px;">← Вернуться к списку</a>

    <form method="POST" action="{{ route('admin.pets.store') }}" enctype="multipart/form-data" style="background: #fff; padding: 20px; border: 1px solid #dee2e6; border-radius: 8px;">

        @include('admin.pets._form')
    </form>
</div>
@endsection
