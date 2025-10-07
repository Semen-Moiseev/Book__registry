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
        return $this->success(new UserResource($user), 'The data has been successfully created', 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !\Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'code' => 401,
                'message' => 'Неверный email или пароль',
            ], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Автор успешно авторизован',
            'data' => [
                'user' => $user,
                'author' => $user->author,
                'token' => $token,
            ],
        ], 200);
    }
}
