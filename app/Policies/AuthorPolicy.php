<?php

namespace App\Policies;

use App\Models\Author;
use App\Models\User;
use App\Enums\UserRole;

class AuthorPolicy
{
    public function update(User $user, Author $author): bool
    {
        return ($author->user_id === $user->id) || ($user->role === UserRole::ADMIN);
    }

    public function delete(User $user, Author $author): bool
    {
        return ($author->user_id === $user->id) || ($user->role === UserRole::ADMIN);
    }
}
