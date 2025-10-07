<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;

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
    public function login()
    {
        $user = $this->repository->login($data);
        return $user;
    }

    // Выход из системы
    public function logout()
    {}
}
