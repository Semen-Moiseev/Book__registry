<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\GenreService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\GenreResource;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use App\Models\Genre;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class GenreController extends Controller
{
    use AuthorizesRequests;

    protected GenreService $service;
    public function __construct(GenreService $service)
    {
        $this->service = $service;
    }

    // GET /api/genres?include= -> Получить список жанров с пагинацией
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('perPage', 5);
        $include = $request->query('include', '');

        $genre = $this->service->getAllGenres($perPage, $include);
        return GenreResource::collection($genre)->response()->setStatusCode(200);
    }

    // GET /api/genres/{id} -> Получить жанр по id
    public function show(int $id): JsonResponse
    {
        $genre = $this->service->getGenreById($id);
        return $this->success(new GenreResource($genre), 'The data was successfully found', 200);
    }

    // POST /api/genres -> Создание жанра
    public function store(StoreGenreRequest $request): JsonResponse
    {
        $this->authorize('create', Genre::class);
        $genre = $this->service->createGenre($request->validated());
        return $this->success(new GenreResource($genre), 'The data has been successfully created', 201);
    }

    // PUT /api/genres/{id} -> Обновление данных жанра по id
    public function update(UpdateGenreRequest $request, Genre $genre): JsonResponse
    {
        $this->authorize('update', $genre);
        $genre = $this->service->updateGenre($genre, $request->validated());
        return $this->success(new GenreResource($genre), 'The data has been successfully updated', 200);
    }

    // DELETE /api/genres/{id} -> Удаление жанра по id
    public function destroy(Genre $genre): JsonResponse
    {
        $this->authorize('delete', $genre);
        $this->service->deleteGenre($genre);
        return $this->success(null, 'The book was deleted successfully', 200);
    }
}
