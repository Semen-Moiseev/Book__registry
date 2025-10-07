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

class UserController extends Controller
{
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
}
