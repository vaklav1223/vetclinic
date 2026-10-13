<?php

use Illuminate\Support\Facades\Route;

// 1. Главная страница
Route::get('/', function () {
    $items = config('catalog.items') ?? [];
    return view('welcom', compact('items'));
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

// 5. Страница питомца
Route::get('/pets/{id}', function ($id) {
    $items = config('catalog.items') ?? [];
    $book = $items[$id] ?? ['title' => "Питомец №{$id}", 'breed' => 'Не указана', 'age' => '-'];
    
    return view('pet', [
        'id' => $id,
        'book' => $book
    ]);
})->name('pets.show')->whereNumber('id');
Route::redirect('/pets', '/');

//6. правила
Route::get('/prav', function () {
    $prav = [
        'prav' => 'правил нет кайфуйте',
    ];
    return view('prav', $prav);
})->name('prav');
Route::prefix('admin')->name('admin.')->middleware('admin.key')->group(function () {
    
    Route::view('/', 'admin.dashboard')->name('dashboard');
    
    Route::get('/pets', function () {
        $items = config('catalog.items') ?? [];
        return view('admin.pets', compact('items'));
    })->name('pets');
    
    Route::view('/pets/create', 'admin.create')->name('pets.create');
    
});
Route::view('/booking', 'booking')->middleware('hours:9,18')->name('booking');
Route::get('/pets', function () {
    $items = config('catalog.items') ?? [];
    return view('catalog', compact('items'));
})->name('pets.index');