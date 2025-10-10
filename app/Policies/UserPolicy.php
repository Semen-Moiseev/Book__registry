<?php

namespace App\Policies;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function update(User $user): bool
    {
        return $user->role === UserRole::ADMIN;
    }
}
