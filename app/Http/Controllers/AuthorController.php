<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Http\Resources\AuthorResource;
use App\Services\AuthorService;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use Illuminate\Http\JsonResponse;

class AuthorController extends Controller
{
    protected AuthorService $service;

    public function __construct(AuthorService $service)
    {
        $this->service = $service;
    }

    // GET /api/authors -> Получить список авторов с пагинацией
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 5);
        $authors = $this->service->getAllAuthors($perPage);
        return AuthorResource::collection($authors)
        ->response()->setStatusCode(200);
    }

    // GET /api/authors/{id} -> Получить автора по id
    public function show(int $id): JsonResponse
    {
        $author = $this->service->getAuthorById($id);
        return $this->success(new AuthorResource($author), 'The data was successfully found', 200);
    }

    // POST /api/authors -> Создание автора
    public function store(StoreAuthorRequest $request): JsonResponse
    {
        $author = $this->service->createAuthor($request->validated());
        return $this->success(new AuthorResource($author), 'The data has been successfully created', 201);
    }

    // PUT /api/authors/{id} -> Обновление данных автора по id
    public function update(UpdateAuthorRequest $request, Author $author): JsonResponse
    {
        $author = $this->service->updateAuthor($author, $request->validated());
        return $this->success(new AuthorResource($author)->fresh(), 'The data has been successfully updated', 200);
    }

    // DELETE /api/authors/{id} -> Удаление автора с определенным id
    public function destroy(Author $author): JsonResponse
    {
        $this->service->deleteAuthor($author);
        return $this->success(null, 'The author was deleted successfully', 204);
    }
}
