<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/profile', [App\Http\Controllers\Dashboard\ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [App\Http\Controllers\Dashboard\ProfileController::class, 'update'])->name('profile.update');
        
        Route::resource('projects', App\Http\Controllers\Dashboard\ProjectController::class);
        Route::resource('skills', App\Http\Controllers\Dashboard\SkillController::class);
        Route::resource('experiences', App\Http\Controllers\Dashboard\ExperienceController::class);
        Route::resource('blogs', App\Http\Controllers\Dashboard\BlogController::class);
    });
});

require __DIR__.'/auth.php';
