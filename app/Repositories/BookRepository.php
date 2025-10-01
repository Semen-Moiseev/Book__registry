<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BookRepository implements BookRepositoryInterface
{
    public function getAll(int $perPage): LengthAwarePaginator
    {
        return Book::with('author')->paginate($perPage);
    }

    public function findById(int $id): ?Book
    {
        return Book::with('author')->find($id);
    }

    public function create(array $data): Book
    {
        return Book::create($data)->load('author');
    }

    public function update(Book $book, array $data): Book
    {
        $book->update($data)->load('author');
        return $book;
    }

    public function delete(Book $book): void
    {
        $book->delete();
    }
}
