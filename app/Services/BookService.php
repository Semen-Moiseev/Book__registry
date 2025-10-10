<?php

namespace App\Services;

use App\Models\Book;
use App\Models\User;
use App\Enums\UserRole;
use App\Repositories\BookRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Exceptions\CustomException;

class BookService
{
    protected BookRepositoryInterface $repository;
    public function __construct(BookRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    // Получить список книг с пагинацией
    public function getAllBooks(int $perPage, string $include): LengthAwarePaginator
    {
        return $this->repository->getAll($perPage, $include);
    }

    // Получить книгу по id
    public function getBookById(int $id): ?Book
    {
        $book = $this->repository->findById($id);
        return $book;
    }

    // Создание книги
    public function createBook(User $user, array $data): Book
    {
        if ($user->role === UserRole::AUTHOR) {
            $data['author_id'] = $user->author->id;
        }
        elseif ($user->role === UserRole::ADMIN && empty($data['author_id'])) {
            throw new CustomException("author_id must be provided by admin", 422);
        }

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
