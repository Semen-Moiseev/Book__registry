<?php

namespace App\Repositories;

use App\Models\Genre;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface GenreRepositoryInterface
{
    public function getAll(int $perPage, string $include): LengthAwarePaginator;

    public function findById(int $id): ?Genre;

    public function create(array $data): Genre;

    public function update(Genre $genre, array $data): Genre;

    public function delete(Genre $genre): void;
}
