<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Author;
use App\Services\UserService;

class UserController extends Controller
{
    protected UserService $service;
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function register(StoreUserRequest $request)
    {
        $user = $this->service->register($request->validated());
        return $this->success(new UserResource($user), 'Регситрация!!!', 201);
    }

    public function login(LoginUserRequest $request): JsonResponse
    {
        $result = $this->service->login($request->validated());
        return $this->success(new UserResource($result), 'Авторизация!!!', 200); // ДОДЕЛАТЬ ???????
    }
}
