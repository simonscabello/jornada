<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\DailyLogController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\CollectionItemController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Habits Routes
    Route::resource('habits', HabitController::class);
    Route::post('habits/{habit}/complete', [HabitController::class, 'complete'])
        ->name('habits.complete');

    // Daily Logs Routes
    Route::resource('daily-logs', DailyLogController::class);

    // Goals Routes
    Route::resource('goals', GoalController::class);
    Route::post('goals/{goal}/complete', [GoalController::class, 'complete'])
        ->name('goals.complete');

    // Collections Routes
    Route::resource('collections', CollectionController::class);

    // Collection Items Routes
    Route::post('collections/{collection}/items', [CollectionItemController::class, 'store'])
        ->name('collection-items.store');
    Route::put('collections/{collection}/items/{item}', [CollectionItemController::class, 'update'])
        ->name('collection-items.update');
    Route::delete('collections/{collection}/items/{item}', [CollectionItemController::class, 'destroy'])
        ->name('collection-items.destroy');
    Route::get('collections/{collection}/items/{item}/edit', [CollectionItemController::class, 'edit'])
        ->name('collection-items.edit');
    Route::post('collections/{collection}/items/reorder', [CollectionItemController::class, 'reorder'])
        ->name('collection-items.reorder');
});

require __DIR__.'/auth.php';
