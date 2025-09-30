<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Http\Resources\BookResource;
use App\Services\BookService;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    protected BookService $service;
    public function __construct(BookService $service)
    {
        $this->service = $service;
    }

    // GET /api/books -> Получить список книг с пагинацией
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 5);
        $books = $this->service->getAllBooks($perPage);
        return BookResource::collection($books)
        ->response()->setStatusCode(200);
    }

    // GET /api/books/{id} -> Получить книгу по id
    public function show(int $id): JsonResponse
    {
        $book = $this->service->getBookById($id);
        return $this->success(new BookResource($book), 'The data was successfully found', 200);
    }

    // POST /api/books -> Создание книги
    public function store(StoreBookRequest $request): JsonResponse
    {
        $book = $this->service->createBook($request->validated());
        return $this->success(new BookResource($book), 'The data has been successfully created', 201);
    }

    // PUT /api/books/{id} -> Обновление данных книги по id
    public function update(UpdateBookRequest $request, Book $book): JsonResponse
    {
        $book = $this->service->updateBook($book, $request->validated());
        return $this->success(new BookResource($book)->fresh(), 'The data has been successfully updated', 200);
    }

    // DELETE /api/books/{id} -> Удаление книги по id
    public function destroy(Book $book): JsonResponse
    {
        $this->service->deleteBook($book);
        return $this->success(null, 'The book was deleted successfully', 204);
    }
}
