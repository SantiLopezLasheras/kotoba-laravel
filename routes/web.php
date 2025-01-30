<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\FlashcardController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\ListController;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Games
Route::get('/games', [GamesController::class, 'index'])->name('games.index');

// Listas
Route::get('/lists', [ListController::class, 'index'])->name('lists.index');
Route::get('/lists/create', [ListController::class, 'create'])->name('lists.create');
Route::get('/lists/{id}', [ListController::class, 'show'])->name('lists.show');
Route::post('/lists', [ListController::class, 'store'])->name('lists.store');
Route::get('/lists/{id}/edit', [ListController::class, 'edit'])->name('lists.edit');
Route::put('/lists/{id}', [ListController::class, 'update'])->name('lists.update');
Route::delete('/lists/{id}', [ListController::class, 'destroy'])->name('lists.destroy');

// Flashcards
Route::get('/lists/{listId}/flashcards', [FlashcardController::class, 'index'])->name('flashcards.index');
Route::get('/lists/{listId}/flashcards/create', [FlashcardController::class, 'create'])->name('flashcards.create');
Route::post('/lists/{listId}/flashcards', [FlashcardController::class, 'store'])->name('flashcards.store');
Route::get('/lists/{listId}/flashcards/{flashcardId}/edit', [FlashcardController::class, 'edit'])->name('flashcards.edit');
Route::put('/lists/{listId}/flashcards/{flashcardId}', [FlashcardController::class, 'update'])->name('flashcards.update');
Route::delete('/lists/{listId}/flashcards/{flashcardId}', [FlashcardController::class, 'destroy'])->name('flashcards.destroy');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
