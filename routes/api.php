<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\BookController;
use App\Http\Controllers\Api\V1\GenreController;

Route::prefix('v1')
    ->name('api.v1.')
    ->middleware('throttle:5,1')
    ->group(function () {
        
        Route::get('/ping', function () {
            return response()->json([
                'status' => 'ок',
                'message' => 'понг'
            ], 200, [], JSON_UNESCAPED_UNICODE);
        })->name('ping');

        Route::get('/stats', [BookController::class, 'stats'])->name('stats');
        Route::get('/books/random', [BookController::class, 'random'])->name('books.random');

        Route::get('/books', [BookController::class, 'index'])->name('books.index');
        Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');
        
        Route::get('/genres', [GenreController::class, 'index'])->name('genres.index');
        Route::get('/genres/{id}/books', [GenreController::class, 'books'])->name('genres.books');

    });
