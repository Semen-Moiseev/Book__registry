<?php

namespace App\Services;

use App\Models\Book;
use App\Repositories\BookRepositoryInterface;
use App\Exceptions\CustomException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BookService
{
    protected BookRepositoryInterface $repository;
    public function __construct(BookRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    // Получить список книг с пагинацией
    public function getAllBooks(int $perPage): LengthAwarePaginator
    {
        return $this->repository->getAll($perPage);
    }

    // Получить книгу по id
    public function getBookById(int $id): ?Book
    {
        $book = $this->repository->findById($id);
        if(!$book) { throw new CustomException("The resource was not found", 404); }
        return $book;
    }

    // Создание книги
    public function createBook(array $data): Book
    {
        $book = $this->repository->create($data);
        return $book;
    }

    // Обновление данных книги по id
    public function updateBook(Book $book, array $data): Book
    {
        $book = $this->repository->update($book, $data);
        return $book;
    }

    // Удаление книги по id
    public function deleteBook(Book $book): void
    {
        $this->repository->delete($book);
    }
}
