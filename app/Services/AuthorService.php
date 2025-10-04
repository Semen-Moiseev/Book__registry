<?php

namespace App\Services;

use App\Models\Author;
use App\Repositories\AuthorRepositoryInterface;
use App\Exceptions\CustomException;

class AuthorService
{
    protected AuthorRepositoryInterface $repository;
    public function __construct(AuthorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    // Получить список авторов с пагинацией
    public function getAllAuthors(int $perPage, string $include)
    {
        return $this->repository->getAll($perPage, $include);
    }

    // Получить автора по id
    public function getAuthorById(int $id): ?Author
    {
        $author = $this->repository->findById($id);
        if(!$author) { throw new CustomException("The resource was not found", 404); }
        return $author;
    }

    // Создание автора
    public function createAuthor(array $data): Author
    {
        $author = $this->repository->create($data);
        return $author;
    }

    // Обновление данных автора по id
    public function updateAuthor(Author $author, array $data): Author
    {
        $author->update($data);
        return $author;
    }

    // Удаление автора по id
    public function deleteAuthor(Author $author): void
    {
        $this->repository->delete($author);
    }
}
