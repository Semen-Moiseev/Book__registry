<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;
use Illuminate\Support\Carbon;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $genres = [
            [
                'name' => 'Роман',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Новелла',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Повесть',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Фантастика',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Поэзия',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Детектив',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        Genre::insert($genres);
    }
}
