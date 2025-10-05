<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name'];

    // Связь: один автор -> много книг
    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'author_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
