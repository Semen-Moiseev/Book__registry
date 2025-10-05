<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Author;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed', // password_confirmation
        ]);

        // Создаем пользователя
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        // Создаем автора с тем же именем и связываем с пользователем
        $author = Author::create([
            'user_id' => $user->id,
            'name' => $user->name,
        ]);

        // Создаем токен для API
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'code' => 201,
            'message' => 'Пользователь и автор созданы успешно',
            'data' => [
                'user' => $user,
                'author' => $author,
                'token' => $token,
            ],
        ], 201);
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
