<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\FlashcardController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\ListController;
// use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// RUTAS PROTEGIDAS
// Listas
Route::middleware(['auth'])->group(function () {
    Route::get('/lists', [ListController::class, 'index'])->name('lists.index');
    Route::get('/lists/create', [ListController::class, 'create'])->name('lists.create');
    Route::post('/lists', [ListController::class, 'store'])->name('lists.store');
    Route::put('/lists/{id}', [ListController::class, 'update'])->name('lists.update');
    Route::delete('/lists/{id}', [ListController::class, 'destroy'])->name('lists.destroy');});


// Flashcards
Route::middleware(['auth'])->group(function () {
    Route::get('/lists/{listId}/flashcards', [FlashcardController::class, 'index'])->name('flashcards.index');
    Route::get('/lists/{listId}/flashcards/create', [FlashcardController::class, 'create'])->name('flashcards.create');
    Route::post('/lists/{listId}/flashcards', [FlashcardController::class, 'store'])->name('flashcards.store');
    Route::get('/lists/{listId}/flashcards/{flashcardId}/edit', [FlashcardController::class, 'edit'])->name('flashcards.edit');
    Route::put('/lists/{listId}/flashcards/{flashcardId}', [FlashcardController::class, 'update'])->name('flashcards.update');
    Route::delete('/lists/{listId}/flashcards/{flashcardId}', [FlashcardController::class, 'destroy'])->name('flashcards.destroy');});

// Games
Route::get('/games', [GamesController::class, 'index'])->name('games.index');
Route::middleware(['auth'])->group(function () {
    Route::get('/games/repasar', [GamesController::class, 'repasar'])->name('games.repasar');
});

// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::put('/banear/{id}', [DashboardController::class, 'banear'])->name('banear');
});

//         function () {
//     if (Auth::user()->role === 'admin') {
//         return Inertia::render('Dashboard');
//     } else {
//         return redirect('/');
//     }
// }


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     if( Auth::user()->role === 'admin') {
//         Route::get('/dashboard', function () {
//             return Inertia::render('Admin');
//         })->name('dashboard');
//     } else {
//         return Inertia::render('/');
//     }
//     // Route::get('/dashboard', function () {
//     //     return Inertia::render('Dashboard');
//     // })->name('dashboard');
// });
