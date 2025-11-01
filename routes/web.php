<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookController;   
use App\Http\Controllers\AuthorController; 

Route::get('/', function () {

    return view('welcome');
});

// 1. Маршрут для головної сторінки (список книг)
// Ми змушуємо існуючий /dashboard використовувати наш BookController
Route::get('/dashboard', [BookController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// 2. Маршрут для сторінки однієї книги
Route::get('/books/{book}', [BookController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('books.show'); // <--- даємо маршруту ім'я

// 3. Маршрут для сторінки одного автора
Route::get('/authors/{author}', [AuthorController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('authors.show'); // <--- даємо маршруту ім'я



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
