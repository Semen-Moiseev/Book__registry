<?php

namespace App\Policies;

use App\Models\Genre;
use App\Models\User;
use App\Enums\UserRole;

class GenrePolicy
{
    public function create(User $user): bool
    {
        return $user->role === UserRole::ADMIN;
    }

    public function update(User $user, Genre $genre): bool
    {
        return $user->role === UserRole::ADMIN;
    }

    public function delete(User $user, Genre $genre): bool
    {
        return $user->role === UserRole::ADMIN;
    }
}
