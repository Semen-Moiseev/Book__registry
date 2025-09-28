<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\AuthorRepositoryInterface;
use App\Repositories\AuthorRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AuthorRepositoryInterface::class, AuthorRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
