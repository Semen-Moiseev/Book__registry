<?php

namespace App\Services;

use App\Models\Author;

class AuthorService
{
    // Получить список авторов с пагинацией
    public function getAllAuthors(int $perPage)
    {
        $authors = Author::paginate($perPage);
        return $authors;
    }

    // Получить автора по id
    public function getAuthorById(int $id): ?Author
    {
        $author = Author::find($id);
        return $author;
    }

    // Создание автора
    public function createAuthor(array $data): Author
    {
        $author = Author::create($data);
        return $author;
    }

    // Обновление данных автора по id
    public function updateAuthor(Author $author, array $data): Author
    {
        $author->update($data);
        return $author;
    }

    // Удаление автора с определенным id
    public function deleteAuthor(Author $author): void
    {
        $author->delete();
    }
}
