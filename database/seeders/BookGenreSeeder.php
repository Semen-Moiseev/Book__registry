<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookGenreSeeder extends Seeder
{
    public function run(): void
    {
        $book_genre = [
            ['book_id' => '1', 'genre_id' => '1'],
            ['book_id' => '1', 'genre_id' => '2'],
            ['book_id' => '2', 'genre_id' => '3'],
            ['book_id' => '3', 'genre_id' => '4'],
            ['book_id' => '4', 'genre_id' => '2'],
            ['book_id' => '5', 'genre_id' => '6'],
        ];

        DB::table('book_genre')->insert($book_genre);
    }
}
