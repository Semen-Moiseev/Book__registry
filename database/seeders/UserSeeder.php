<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Enums\UserRole;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $authors = [
            [
                'name' => 'Пушкин А.С.',
                'role' => UserRole::AUTHOR,
                'email' => 'email-1@mail.ru',
                'password' => Hash::make('password'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Толстой Л.Н.',
                'role' => UserRole::AUTHOR,
                'email' => 'email-2@mail.ru',
                'password' => Hash::make('password'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Гоголь Н.В.',
                'role' => UserRole::AUTHOR,
                'email' => 'email-3@mail.ru',
                'password' => Hash::make('password'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Лермонтов М.Ю.',
                'role' => UserRole::AUTHOR,
                'email' => 'email-4@mail.ru',
                'password' => Hash::make('password'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        $admins = [
            [
                'name' => 'Администратор',
                'role' => UserRole::ADMIN,
                'email' => 'admin@mail.ru',
                'password' => Hash::make('password'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        User::insert($authors);
        User::insert($admins);
    }
}
