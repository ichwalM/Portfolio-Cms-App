<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PortfolioApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->middleware('api.key')->group(function () {
    Route::get('/profile', [PortfolioApiController::class, 'getProfile']);
    Route::get('/projects', [PortfolioApiController::class, 'getProjects']);
    Route::get('/projects/{slug}', [PortfolioApiController::class, 'getProject']);
    Route::get('/skills', [PortfolioApiController::class, 'getSkills']);
    Route::get('/experiences', [PortfolioApiController::class, 'getExperiences']);
    Route::get('/posts', [PortfolioApiController::class, 'getPosts']);
    Route::get('/posts/{slug}', [PortfolioApiController::class, 'getPost']);
    Route::get('/about', [PortfolioApiController::class, 'getAbout']);
    Route::post('/visits', [App\Http\Controllers\Api\VisitApiController::class, 'store']);
});
