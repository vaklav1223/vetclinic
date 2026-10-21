<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\PetController; 
use App\Http\Controllers\PageController; 
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PetController as AdminPetController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Storage;

Route::get('/', [PageController::class, 'home'])->name('welcom');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contacts', [PageController::class, 'contacts'])->name('contacts');
Route::get('/prav', [PageController::class, 'rules'])->name('prav');
Route::get('/pets', [PetController::class, 'index'])->name('pets.index');
Route::get('/pets/pdf', [PetController::class, 'pdf'])->name('pets.pdf');
Route::get('/pets/{pet}', [PetController::class, 'show'])->name('pets.show');
Route::get('/owners/{owner}', [OwnerController::class, 'show'])->name('owners.show');

Route::get('/hello/{name}', function ($name) {
    return "Здравствуйте, {$name}! Добро пожаловать в Ветеринарную клинику.";
});

Route::view('/booking', 'booking')->middleware('hours:9,18')->name('booking');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'can:admin-panel'])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('pets', AdminPetController::class)->except(['show']);
    Route::resource('owners', OwnerController::class);
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
    
    Route::get('/login', function () {
        return 'Форма входа (в процессе разработки)';
    })->name('login');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [LoginController::class, 'create'])->name('login');

    Route::post('/login', [LoginController::class, 'store'])->middleware('throttle:5,1');
});
Route::middleware('auth')->group(function () {
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});
Route::get('/pets/{pet}/attachment', function (\App\Models\Pet $pet) {
    if (!$pet->attachment) {
        abort(404);
    }
    
    $extension = pathinfo($pet->attachment, PATHINFO_EXTENSION);
    
    return Storage::download($pet->attachment, 'Документ_питомца.' . $extension);
})->middleware('auth')->name('pets.attachment.download');