<?php

namespace App\Repositories;

use App\Models\Author;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AuthorRepository implements AuthorRepositoryInterface
{
    public function getAll(int $perPage, string $include): LengthAwarePaginator
    {
        // Получить список авторов с кол-вом книг с пагинацией
        if (str_contains($include, 'books-count')) {
            return Author::withCount('books')->paginate($perPage);
        }

        // Получить список авторов со списком книг с пагинацией
        if (str_contains($include, 'books')) {
            return Author::with('books')->paginate($perPage);
        }

        return Author::paginate($perPage);
    }

    public function findById(int $id): ?Author
    {
        return Author::findOrFail($id);
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
