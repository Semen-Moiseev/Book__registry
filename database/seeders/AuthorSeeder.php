<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        Author::create([
            'name' => 'Пушкин А.С.',
        ]);

        Author::create([
            'name' => 'Толстой Л.Н.',
        ]);

        Author::create([
            'name' => 'Гоголь Н.В.',
        ]);

        Author::create([
            'name' => 'Лермонтов М.Ю.'
        ]);
    }
}
