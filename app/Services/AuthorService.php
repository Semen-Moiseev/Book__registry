<?php

namespace App\Services;

use App\Models\Author;
use App\Repositories\AuthorRepositoryInterface;

class AuthorService
{
    protected AuthorRepositoryInterface $repository;

    public function __construct(AuthorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    // Получить список авторов с пагинацией
    public function getAllAuthors(int $perPage)
    {
        return $this->repository->getAll($perPage);
    }

    // Получить автора по id
    public function getAuthorById(int $id): ?Author
    {
        return $this->repository->findById($id);
    }

    // Создание автора
    public function createAuthor(array $data): Author
    {
        // $author = $this->repository->create($data);
        // return $author;
        return $this->repository->create($data);
    }

    // Обновление данных автора по id
    public function updateAuthor(Author $author, array $data): Author
    {
        // $author->update($data);
        // return $author;
        return $this->repository->update($author, $data);
    }

    // Удаление автора с определенным id
    public function deleteAuthor(Author $author): void
    {
        $this->repository->delete($author);
    }
}
