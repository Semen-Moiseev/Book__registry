<?php

namespace App\Repositories;

use App\Models\Genre;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GenreRepository implements GenreRepositoryInterface
{
    public function getAll(int $perPage, string $include): LengthAwarePaginator
    {
        // Получить список авторов с кол-вом книг с пагинацией
        if (str_contains($include, 'books')) {
            return Genre::with('books')->paginate($perPage);
        }

        return Genre::paginate($perPage);
    }

    public function findById(int $id): ?Genre
    {
        return Genre::find($id);
    }

    public function create(array $data): Genre
    {
        return Genre::create($data);
    }

    public function update(Genre $genre, array $data): Genre
    {
        $genre->update($data);
        return $genre;
    }

    public function delete(Genre $genre): void
    {
        $genre->delete();
    }
}
