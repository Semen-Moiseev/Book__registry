<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Author;
use App\Services\UserService;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{
    use AuthorizesRequests;

    protected UserService $service;
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function register(RegisterUserRequest $request): JsonResponse
    {
        $user = $this->service->register($request->validated());
        return $this->success(new UserResource($user), 'The user has been successfully registered', 201);
    }

    public function login(LoginUserRequest $request): JsonResponse
    {
        $result = $this->service->login($request->validated());
        return $this->success(new UserResource($result['user']), 'The user has been successfully logged in', 200, ['token' => $result['token']]);
    }

    public function logout(Request $request): JsonResponse
    {
        $this->service->logout($request->user());
        return $this->success(null, 'The user has been successfully logged out', 200);
    }

    public function makeAdmin(User $user): JsonResponse
    {
        $this->authorize('update', User::class);
        $this->service->promoteToAdmin($user);
        return $this->success(null, 'User has been successfully promoted to administrator.', 200);
    }

    public function makeAuthor(User $user): JsonResponse
    {
        $this->authorize('update', User::class);
        $this->service->promoteToAuthor($user);
        return $this->success(null, 'User has been successfully promoted to author.', 200);
    }
}
