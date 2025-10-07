<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    public function register(array $data): User;

    public function login(array $data): ?array;

    public function logout();
}
