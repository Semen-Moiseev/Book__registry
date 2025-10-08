<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BookRepository implements BookRepositoryInterface
{
    public function getAll(int $perPage): LengthAwarePaginator
    {
        return Book::with(['author', 'genres'])->paginate($perPage);
    }

    public function findById(int $id): ?Book
    {
        return Book::with(['author', 'genres'])->findOrFail($id);
    }

    public function create(array $data): Book
    {
        $book = Book::create($data);
        if (!empty($data['genres']) && is_array($data['genres'])) {
            $book->genres()->attach($data['genres']);
        }
        return $book->load(['author', 'genres']);
    }

    public function update(Book $book, array $data): Book
    {
        $book->update($data);
        if (!empty($data['genres']) && is_array($data['genres'])) {
            $book->genres()->sync($data['genres']);
        }
        return $book->load(['author', 'genres']);
    }

    public function delete(Book $book): void
    {
        $book->delete();
    }
}
