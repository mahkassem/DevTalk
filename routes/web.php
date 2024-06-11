<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', [AuthController::class, 'viewLogin'])->name('login');
Route::post('/login', [AuthController::class, 'webLogin'])->name('webLogin');
Route::post('/logout', [AuthController::class, 'logoutWeb'])->name('logoutWeb');

// Posts
Route::get('/timeline', [ArticleController::class, 'timeline'])->name('articles.timeline');
