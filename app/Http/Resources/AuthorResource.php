<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'books_count' => $this->when(isset($this->books_count), $this->books_count),
            'books' => $this->when($this->relationLoaded('books'), $this->books),
        ];
    }
}
