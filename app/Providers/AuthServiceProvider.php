<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Policies\BookPolicy;
use App\Models\Book;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Gate::policy(Book::class, BookPolicy::class);
    }
}
