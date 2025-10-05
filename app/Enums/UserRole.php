<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case AUTHOR = 'author';

    public function label(): string
    {
        return match($this) {
            self::ADMIN => 'Администратор',
            self::AUTHOR => 'Автор',
        };
    }
}
