<?php

namespace App\Services;

use App\Models\User;
use App\Models\Author;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Enums\UserRole;
use App\Exceptions\CustomException;

class UserService
{
    protected UserRepositoryInterface $repository;
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function register(array $data): User
    {
        $user = $this->repository->register($data);
        return $user;
    }

    public function login(array $data): ?array
    {
        $user = $this->repository->findUserByEmail($data['email']);

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([ 'email' => ['Invalid credentials.'], ]);
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

    public function promoteToAdmin(User $user): void
    {
        if ($user->role === UserRole::ADMIN) throw new CustomException('This user is already an administrator.', 400);
        $this->repository->makeAdmin($user);
    }

    public function promoteToAuthor(User $user): void
    {
        if ($user->role === UserRole::AUTHOR) throw new CustomException('This user is already an author.', 400);
        $this->repository->makeAuthor($user);
    }
}
