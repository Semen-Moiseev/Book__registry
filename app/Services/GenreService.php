<?php

namespace App\Services;

use App\Models\Genre;
use App\Repositories\GenreRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GenreService
{
    protected GenreRepositoryInterface $repository;
    public function __construct(GenreRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    // Получить список жанров с пагинацией
    public function getAllGenres(int $perPage, string $include): LengthAwarePaginator
    {
        return $this->repository->getAll($perPage, $include);
    }

    // Получить жанр по id
    public function getGenreById (int $id): ?Genre
    {
        $genre = $this->repository->findById($id);
        return $genre;
    }

    // Создание жанра
    public function createGenre (array $data): Genre
    {
        $genre = $this->repository->create($data);
        return $genre;
    }

    // Обновление данных жанра по id
    public function updateGenre (Genre $genre, array $data): Genre
    {
        $genre = $this->repository->update($genre, $data);
        return $genre;
    }

    // Удаление жанра по id
    public function deleteGenre (Genre $genre): void
    {
        $this->repository->delete($genre);
    }
}
