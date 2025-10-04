<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            ['name' => 'Роман'],
            ['name' => 'Новелла'],
            ['name' => 'Повесть'],
            ['name' => 'Фантастика'],
            ['name' => 'Поэзия'],
            ['name' => 'Детектив'],
        ];

        Genre::insert($genres);
    }
}
