<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Exceptions\CustomException;
use Illuminate\Http\Request;
use App\Providers\AuthServiceProvider;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withProviders([
        AuthServiceProvider::class,
    ])
    ->withExceptions(function (Exceptions $exceptions,) {
        $exceptions->render(function (Throwable $e, Illuminate\Http\Request $request) {
            // Обрабатываем API запросы
            if ($request->is('api/*') || $request->expectsJson()) {

                $status = 500;
                $message = 'An error has occurred on the server';

                // Модель не найдена -> 404
                if (
                    $e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException ||
                    $e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
                ) {
                    $status = 404;
                    $message = 'The resource was not found';
                }
                // Ошибки валидации -> 422
                elseif ($e instanceof \Illuminate\Validation\ValidationException) {
                    $status = 422;
                    $message = 'Validation error';
                }
                // Не авторизован -> 401
                elseif ($e instanceof \Illuminate\Auth\AuthenticationException) {
                    $status = 401;
                    $message = 'Not authorized';
                }
                // Нет прав -> 403
                elseif ($e instanceof \Illuminate\Auth\Access\AuthorizationException) {
                    $status = 403;
                    $message = 'No access';
                }
                // Другое HTTP-исключение
                elseif ($e instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
                    $status = $e->getStatusCode();
                    $message = $e->getMessage() ?: 'An error has occurred on the server';
                }

                $response = [
                    'success' => false,
                    'code' => $status,
                    'message' => $message,
                ];

                // Детали для ошибки валидации
                if ($e instanceof \Illuminate\Validation\ValidationException) {
                    $response['errors'] = $e->errors();
                }

                return response()->json($response, $status);
            }

            // Для не-API запросов используем стандартную обработку
            return null;
        });
    })->create();
