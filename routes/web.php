<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController; 
use App\Http\Controllers\PageController; 
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PetController as AdminPetController;
use App\Http\Controllers\OwnerController;

// 1. Главная страница
Route::get('/', [PageController::class, 'home'])->name('welcom');

// 2. Страница о проекте
Route::get('/about', [PageController::class, 'about'])->name('about');

// 3. Страница контакты
Route::get('/contacts', [PageController::class, 'contacts'])->name('contacts');

// 4. Приветствие по имени 
Route::get('/hello/{name}', function ($name) {
    return "Здравствуйте, {$name}! Добро пожаловать в Ветеринарную клинику.";
});

Route::get('/pets/{pet}', [PetController::class, 'show'])->name('pets.show');

//6. правила
Route::get('/prav', [PageController::class, 'rules'])->name('prav');

Route::prefix('admin')->name('admin.')->middleware('admin.key')->group(function () {
    
    Route::get('/', DashboardController::class)->name('dashboard');
    
    Route::get('/pets', [AdminPetController::class, 'index'])->name('pets');
    
    Route::get('/pets/create', [AdminPetController::class, 'create'])->name('pets.create');
    
});

Route::view('/booking', 'booking')->middleware('hours:9,18')->name('booking');

Route::get('/pets', [PetController::class, 'index'])->name('pets.index');

Route::get('/admin/logout', function (\Illuminate\Http\Request $request) {
    $request->session()->forget('is_admin');
    return redirect('/');
})->name('admin.logout');
Route::get('/owners/{owner}', [OwnerController::class, 'show'])->name('owners.show');

