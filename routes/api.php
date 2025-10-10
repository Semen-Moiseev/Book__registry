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

Route::POST('/users/make-admin/{user}', [UserController::class, 'makeAdmin'])->middleware('auth:sanctum');
Route::POST('/users/make-author/{user}', [UserController::class, 'makeAuthor'])->middleware('auth:sanctum');

// Стандартные CRUD операции

Route::GET('/authors', [AuthorController::class, 'index']);
Route::GET('/authors/{author}', [AuthorController::class, 'show']);
Route::PUT('/authors/{author}', [AuthorController::class, 'update'])->middleware('auth:sanctum');
Route::DELETE('/authors/{author}', [AuthorController::class, 'destroy'])->middleware('auth:sanctum');

Route::GET('/books', [BookController::class, 'index']);
Route::GET('/books/{book}', [BookController::class, 'show']);
Route::POST('/books', [BookController::class, 'store'])->middleware('auth:sanctum');
Route::PUT('/books/{book}', [BookController::class, 'update'])->middleware('auth:sanctum');
Route::DELETE('/books/{book}', [BookController::class, 'destroy'])->middleware('auth:sanctum');

Route::GET('/genres', [GenreController::class, 'index']);
Route::GET('/genres/{genre}', [GenreController::class, 'show']);
Route::POST('/genres', [GenreController::class, 'store'])->middleware('auth:sanctum');
Route::PUT('/genres/{genre}', [GenreController::class, 'update'])->middleware('auth:sanctum');
Route::DELETE('/genres/{genre}', [GenreController::class, 'destroy'])->middleware('auth:sanctum');

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
