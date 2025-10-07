<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Author;

class UserRepository implements UserRepositoryInterface
{
    public function register(array $data): User
    {
        // Создаем пользователя
        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => $data->password,
        ]);

        // Создаем автора с тем же именем и связываем с пользователем
        $author = Author::create([
            'user_id' => $data->id,
            'name' => $data->name,
        ]);

        // Создаем токен для API
        $token = $user->createToken('api-token')->plainTextToken;

        $user->token = $token;
        $user->author = $author;

        return $user;
    }
}
