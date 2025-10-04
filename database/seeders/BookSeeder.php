<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            ['title' => 'Книга 1', 'author_id' => '1', 'type' => 'print'],
            ['title' => 'Книга 2', 'author_id' => '1', 'type' => 'digital'],
            ['title' => 'Книга 3', 'author_id' => '2', 'type' => 'graphic'],
            ['title' => 'Книга 4', 'author_id' => '3', 'type' => 'print'],
            ['title' => 'Книга 5', 'author_id' => '4', 'type' => 'graphic'],
        ];

        Book::insert($books);
    }
}
