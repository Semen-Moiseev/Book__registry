<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GenreResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // Для разработчика (?raw=1)
        if ($request->query('raw') === '1') {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'books' => $this->whenLoaded('books', function () {
                    return $this->books->pluck('id');
                }),
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ];
        }

        // Для пользователя
        return [
            'id' => $this->id,
            'name' => $this->name,
            'books' => $this->whenLoaded('books', function () {
                return $this->books->pluck('title');
            }),
        ];
    }
}
