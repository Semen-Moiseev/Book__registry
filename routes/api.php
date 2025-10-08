<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\UserController;

// Специальны endpoints

Route::POST('/register', [UserController::class, 'register']);
Route::POST('/login', [UserController::class, 'login']);
Route::POST('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

// Стандартные CRUD операции

Route::apiResource('authors', AuthorController::class);
Route::apiResource('books', BookController::class);
Route::apiResource('genres', GenreController::class);

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
