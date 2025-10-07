<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class BookGenreSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $book_genre = [
            [
                'book_id' => '1',
                'genre_id' => '1',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'book_id' => '1',
                'genre_id' => '2',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'book_id' => '2',
                'genre_id' => '3',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'book_id' => '3',
                'genre_id' => '4',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'book_id' => '4',
                'genre_id' => '2',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'book_id' => '5',
                'genre_id' => '6',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('book_genre')->insert($book_genre);
    }
}
