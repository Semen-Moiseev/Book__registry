<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

// Стандартные CRUD операции

Route::apiResource('authors', AuthorController::class);
Route::apiResource('books', BookController::class);

// Специальны endpoints

//Route::GET('/authors', [AuthorController::class, 'index']);

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
