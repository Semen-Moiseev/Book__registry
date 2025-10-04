<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\BookType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    protected $fillable = ['title', 'author_id', 'type'];

    protected $casts = [
        'type' => BookType::class,
    ];

    //Связь: одна книга -> один автор
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    //Связь: одна книга -> много жанров
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'book_genre');
    }
}
