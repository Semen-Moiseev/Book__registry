<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\AuthorRepositoryInterface;
use App\Repositories\AuthorRepository;
use App\Repositories\BookRepositoryInterface;
use App\Repositories\BookRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AuthorRepositoryInterface::class, AuthorRepository::class);
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
