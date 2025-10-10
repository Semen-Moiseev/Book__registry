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
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AuthorController extends Controller
{
    use AuthorizesRequests;

    protected AuthorService $service;
    public function __construct(AuthorService $service)
    {
        $this->service = $service;
    }

    // GET /api/authors?include= -> Получить список авторов с пагинацией
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 5);
        $include = $request->query('include', '');

        $authors = $this->service->getAllAuthors($perPage, $include);
        return AuthorResource::collection($authors)
        ->response()->setStatusCode(200);
    }

    // GET /api/authors/{id} -> Получить автора по id
    public function show(int $id): JsonResponse
    {
        $author = $this->service->getAuthorById($id);
        return $this->success(new AuthorResource($author), 'The data was successfully found', 200);
    }

    // PUT /api/authors/{id} -> Обновление данных автора по id
    public function update(UpdateAuthorRequest $request, Author $author): JsonResponse
    {
        $this->authorize('update', $author);
        $author = $this->service->updateAuthor($author, $request->validated());
        return $this->success(new AuthorResource($author), 'The data has been successfully updated', 200);
    }

    // DELETE /api/authors/{id} -> Удаление автора по id
    public function destroy(Author $author): JsonResponse
    {
        $this->authorize('delete', $author);
        $this->service->deleteAuthor($author);
        return $this->success(null, 'The author was deleted successfully', 200);
    }
}
