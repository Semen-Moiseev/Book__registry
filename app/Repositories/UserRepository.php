<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Author;
use Illuminate\Support\Facades\Hash;

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

    public function login(array $data): ?array
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials.'],
            ]);
        }

        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
        'user' => $user,
        'token' => $token,
    ];
    }

    public function logout(User $user): void
    {
        $user->tokens()->delete();
    }
}
