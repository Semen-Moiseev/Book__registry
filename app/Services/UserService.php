<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected UserRepositoryInterface $repository;
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    // Регистрация пользователя под автором
    public function register(array $data): User
    {
        $user = $this->repository->register($data);
        return $user;
    }

    // Авторизация пользователя под автором
    public function login(array $data): ?array
    {
        $user = $this->repository->findUserByEmail($data['email']);

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

    // Выход из системы
    public function logout(User $user): void
    {
        $user->tokens()->delete();
    }
}
