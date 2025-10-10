<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    public function register(array $data): User;
    public function findUserByEmail(string $email): ?User;
    public function makeAdmin(User $user): void;
    public function makeAuthor(User $user): void;
}
