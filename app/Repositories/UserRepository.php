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

    public function login(array $data): ?array
    {
        // Ищем пользователя по email
        $user = User::where('email', $credentials['email'])->first();

        // Проверяем пароль
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Неверный email или пароль.'],
            ]);
        }

        // Удаляем старые токены (по желанию, для безопасности)
        $user->tokens()->delete();

        // Создаём новый Sanctum токен
        $token = $user->createToken('auth_token')->plainTextToken;

        // Возвращаем результат
        $user->token = $token;
        return $user;
    }
}
