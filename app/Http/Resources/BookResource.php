<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // Для разработчика (?raw=1)
        if ($request->query('raw') === '1') {
            return [
                'id' => $this->id,
                'title' => $this->title,
                'type' => $this->type,
                'author_id' => $this->author_id,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ];
        }

        // Для пользователя
        return [
            'id' => $this->id,
            'title' => $this->title,
            'type' => $this->type->label(),
            'author' => new AuthorResource($this->whenLoaded('author')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
