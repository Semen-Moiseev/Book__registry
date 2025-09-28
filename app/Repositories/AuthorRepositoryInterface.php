<?php

namespace App\Repositories;

use App\Models\Author;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface AuthorRepositoryInterface
{
    public function getAll(int $perPage): LengthAwarePaginator;

    public function findById(int $id): ?Author;

    public function create(array $data): Author;

    public function update(Author $author, array $data): Author;

    public function delete(Author $author): void;
}
