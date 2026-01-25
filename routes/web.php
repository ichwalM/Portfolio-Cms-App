<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Dashboard\DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/generate-key', [App\Http\Controllers\Dashboard\DashboardController::class, 'generateApiKey'])->name('dashboard.generate-key');

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/profile', [App\Http\Controllers\Dashboard\ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [App\Http\Controllers\Dashboard\ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/account', [App\Http\Controllers\Dashboard\ProfileController::class, 'updateAccount'])->name('profile.account.update');
        
        Route::get('/about', [App\Http\Controllers\Dashboard\AboutController::class, 'edit'])->name('about.edit');
        Route::put('/about', [App\Http\Controllers\Dashboard\AboutController::class, 'update'])->name('about.update');
        
        Route::resource('projects', App\Http\Controllers\Dashboard\ProjectController::class);
        Route::resource('skills', App\Http\Controllers\Dashboard\SkillController::class);
        Route::resource('experiences', App\Http\Controllers\Dashboard\ExperienceController::class);
        Route::resource('blogs', App\Http\Controllers\Dashboard\BlogController::class);
        Route::delete('/blogs/{blog}/photo/{index}', [App\Http\Controllers\Dashboard\BlogController::class, 'deletePhoto'])->name('blogs.photo.delete');
    });
});

require __DIR__.'/auth.php';
