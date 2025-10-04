<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // Для разработчика (?raw=1)
        if ($request->query('raw') === '1') {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'books_count' => $this->when(isset($this->books_count), $this->books_count),
                'books' => $this->when($this->relationLoaded('books'), $this->books),
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ];
        }

        // Для пользователя
        return [
            'id' => $this->id,
            'name' => $this->name,
            'books_count' => $this->when(isset($this->books_count), $this->books_count),
            'books' => $this->when($this->relationLoaded('books'), $this->books),
        ];
    }
}
