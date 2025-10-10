<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Author;
use App\Enums\UserRole;

class UserRepository implements UserRepositoryInterface
{
    public function register(array $data): User
    {
        // Создаем пользователя
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        // Создаем автора с тем же именем и связываем с пользователем
        Author::create([
            'user_id' => $user->id,
            'name' => $user->name,
        ]);

        return $user;
    }

    public function findUserByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function makeAdmin(User $user): void
    {
        $user->update(['role' => UserRole::ADMIN]);
    }

    public function makeAuthor(User $user): void
    {
        $user->update(['role' => UserRole::AUTHOR]);
    }
}
