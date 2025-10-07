<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use Illuminate\Support\Carbon;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $books = [
            [
                'title' => 'Книга 1',
                'author_id' => '1',
                'type' => 'print',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Книга 2',
                'author_id' => '1',
                'type' => 'digital',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Книга 3',
                'author_id' => '2',
                'type' => 'graphic',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Книга 4',
                'author_id' => '3',
                'type' => 'print',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Книга 5',
                'author_id' => '4',
                'type' => 'graphic',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        Book::insert($books);
    }
}
