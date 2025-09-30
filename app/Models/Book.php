<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\BookType;

class Book extends Model
{
    protected $fillable = ['title', 'type'];

     protected $casts = [
        'type' => BookType::class,
    ];
}
