@extends('layouts.app')

@section('title', 'Вход')

@section('content')
<div class="register-container">
    <h2>Вход в систему</h2>
    
    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}">

            @error('email')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password">
        </div>

        <div class="form-group" style="display: flex; align-items: center; gap: 10px;">
            <input type="checkbox" id="remember" name="remember" style="width: auto;">
            <label for="remember" style="margin: 0; font-weight: normal;">Запомнить меня</label>
        </div>

        <button type="submit" class="btn-submit">Войти</button>
    </form>
</div>

<style>
    .register-container {
        max-width: 400px;
        margin: 50px auto;
        padding: 30px;
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        font-family: Arial, sans-serif;
        border: 1px solid #e1e4e6;
    }
    .register-container h2 {
        text-align: center;
        margin-top: 0;
        margin-bottom: 25px;
        color: #333;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #495057;
        font-size: 14px;
        font-weight: bold;
        text-align: left;
    }
    .form-group input {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        font-size: 14px;
        box-sizing: border-box;
    }
    .error-message {
        color: #dc3545;
        font-size: 12px;
        margin-top: 5px;
        display: block;
        text-align: left;
    }
    .btn-submit {
        width: 100%;
        padding: 12px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
    }
    .btn-submit:hover {
        background-color: #0056b3;
    }
</style>
@endsection
