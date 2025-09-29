<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Exceptions\CustomException;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions,) {
        $exceptions->render(function (Throwable $e, Illuminate\Http\Request $request) {
            // Обрабатываем только API запросы
            if ($request->is('api/*') || $request->expectsJson()) {

                // Определяем статус код
                $status = 500;
                $message = 'Произошла ошибка на сервере';

                // CustomException
                if ($e instanceof \App\Exceptions\CustomException) {
                    $status = $e->getStatusCode();
                    $message = 'Ресурс не найден';
                }
                // Модель не найдена -> 404
                elseif ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                    $status = 404;
                    $message = 'Ресурс не найден';
                }
                // Ошибки валидации -> 422
                elseif ($e instanceof \Illuminate\Validation\ValidationException) {
                    $status = 422;
                    $message = 'Ошибка валидации';
                }
                // Неавторизован -> 401
                elseif ($e instanceof \Illuminate\Auth\AuthenticationException) {
                    $status = 401;
                    $message = 'Не авторизован';
                }
                // Нет прав -> 403
                elseif ($e instanceof \Illuminate\Auth\Access\AuthorizationException) {
                    $status = 403;
                    $message = 'Нет доступа';
                }
                // Любое другое HTTP-исключение
                elseif ($e instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
                    $status = $e->getStatusCode();
                    $message = $e->getMessage() ?: 'Произошла ошибка на сервере';
                }

                // Формируем JSON ответ ТОЛЬКО с нужными полями
                $response = [
                    'success' => false,
                    'code' => $status,
                    'message' => $message,
                ];

                // Для ошибок валидации добавляем детали
                if ($e instanceof \Illuminate\Validation\ValidationException) {
                    $response['errors'] = $e->errors();
                }

                return response()->json($response, $status);
            }

            // Для не-API запросов используем стандартную обработку
            return null;
        });
    })->create();
