<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            ['name' => 'Пушкин А.С.'],
            ['name' => 'Толстой Л.Н.'],
            ['name' => 'Гоголь Н.В.'],
            ['name' => 'Лермонтов М.Ю.'],
        ];

        Author::insert($authors);
    }
}
