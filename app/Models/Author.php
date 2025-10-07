<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name'];

    // Связь: один автор -> много книг (связан)
    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'author_id');
    }

    // Связь: один автора -> один пользователь (принадлежит)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
