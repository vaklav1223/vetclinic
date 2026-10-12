<?php

use Illuminate\Support\Facades\Route;

// 1. Главная страница 
Route::get('/', function () {
    return view('welcom');
})->name('welcom');

// 2. Страница о проекте
Route::get('/about', function () {
    $data = [
        'fio' => 'Варлаков Сергей', 
        'group' => '3ПОВТ24Б',
        'description' => 'Проект представляет собой веб-приложение для ветеринарной клиники. Оно позволяет вести учет питомцев, управлять записями к врачам и отслеживать историю лечения пациентов.'
    ];
    return view('about', $data);
})->name('about');

// 3. Страница контакты
Route::get('/contacts', function () {
    $contacts = [
        'address' => 'г. костанай, ул. Ветеринарная, д. 10',
        'phone' => '+7 (495) 123-45-67',
        'email' => 'info@vetclinic-example.ru'
    ];
    return view('contacts', $contacts);
})->name('contacts');

// 4. Приветствие по имени 
Route::get('/hello/{name}', function ($name) {
    return "Здравствуйте, {$name}! Добро пожаловать в Ветеринарную клинику.";
});

// 5. Страница питомца с проверкой на число
Route::get('/pets/{id}', function ($id) {
    return view('pet', ['id' => $id]);
})->name('pets.show')->whereNumber('id');
