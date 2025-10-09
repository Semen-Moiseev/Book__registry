<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use App\Enums\UserRole;

class BookPolicy
{
    public function update(User $user, Book $book): bool
    {
        return ($book->author->user_id === $user->id) || ($user->role === UserRole::ADMIN);
    }

    public function delete(User $user, Book $book): bool
    {
        return ($book->author->user_id === $user->id) || ($user->role === UserRole::ADMIN);
    }
}
