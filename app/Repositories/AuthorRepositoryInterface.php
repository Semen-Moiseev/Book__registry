<?php

namespace App\Repositories;

use App\Models\Author;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface AuthorRepositoryInterface
{
    public function getAll(int $perPage, string $include): LengthAwarePaginator;

    public function findById(int $id, string $include): ?Author;

    public function update(Author $author, array $data): Author;

    public function delete(Author $author): void;
}
