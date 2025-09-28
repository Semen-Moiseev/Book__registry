<?php

namespace App\Repositories;

use App\Models\Author;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AuthorRepository implements AuthorRepositoryInterface
{
    public function getAll(int $perPage): LengthAwarePaginator
    {
        return Author::paginate($perPage);
    }

    public function findById(int $id): ?Author
    {
        return Author::find($id);
    }

    public function create(array $data): Author
    {
        return Author::create($data);
    }

    public function update(Author $author, array $data): Author
    {
        $author->update($data);
        return $author;
    }

    public function delete(Author $author): void
    {
        $author->delete();
    }
}
