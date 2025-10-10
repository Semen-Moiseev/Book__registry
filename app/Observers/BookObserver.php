<?php

namespace App\Observers;

use App\Models\Book;
use Illuminate\Support\Facades\Log;

class BookObserver
{
    public function created(Book $book): void
    {
        Log::channel('books')->info('Book created', [
            'book_id' => $book->id,
            'title' => $book->title,
            'author_id' => $book->author_id,
            'user_id' => auth()->id(),
            'action' => 'created',
        ]);
    }

    public function updated(Book $book): void
    {
        Log::channel('books')->info('Book updated', [
            'book_id' => $book->id,
            'title' => $book->title,
            'author_id' => $book->author_id,
            'user_id' => auth()->id(),
            'changes' => $book->getChanges(),
            'action' => 'updated',
        ]);
    }

    public function deleted(Book $book): void
    {
        Log::channel('books')->info('Book deleted', [
            'book_id' => $book->id,
            'title' => $book->title,
            'author_id' => $book->author_id,
            'user_id' => auth()->id(),
            'action' => 'deleted',
        ]);
    }
}
