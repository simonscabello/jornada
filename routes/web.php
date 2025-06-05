<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\DailyLogController;
use App\Http\Controllers\GoalController;

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
});

Route::middleware('auth')->group(function () {
    Route::resource('habits', HabitController::class);
    Route::post('habits/{habit}/complete', [HabitController::class, 'complete'])
        ->name('habits.complete');
    Route::resource('daily-logs', DailyLogController::class);
    Route::resource('goals', GoalController::class);
    Route::post('goals/{goal}/complete', [GoalController::class, 'complete'])
        ->name('goals.complete');
});

require __DIR__.'/auth.php';
