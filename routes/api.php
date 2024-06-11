<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    SendEmailJob::dispatch('Mahmoud', 'mail@example.com');
});

Route::group(
    [
        'prefix' => 'articles',
    ],
    function () {
        Route::get('/', [ArticleController::class, 'index']);
        Route::get('/{id}', [ArticleController::class, 'single']);
        Route::post('/', [ArticleController::class, 'create'])->middleware('auth:sanctum');
        Route::post('/update', [ArticleController::class, 'update'])->middleware('auth:sanctum');
        Route::patch('/', [ArticleController::class, 'publish'])->middleware('auth:sanctum');
        Route::delete('/{id}', [ArticleController::class, 'delete'])->middleware('auth:sanctum');
    }
);

Route::group(
    [
        'prefix' => 'auth',
    ],
    function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
    }
);
