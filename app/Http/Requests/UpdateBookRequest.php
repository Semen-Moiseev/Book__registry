<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\BookType;

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Не обязательно, но если оно есть в запросе, будет проверено | Строка | Длина не больше 255 | Уникально, только для этого автора, не сравнивая с текущим
            'title' => ['sometimes', 'string', 'max:255', Rule::unique('books')->ignore($this->book->id)->where(fn ($query) => $query->where('author_id', $this->input('author_id'))),],
            // Не обязательно, но если оно есть в запросе, будет проверено | Строка | Входит в enum
            'type' => ['sometimes', 'string', Rule::enum(BookType::class)],
            // Не обязательно, но если оно есть в запросе, будет проверено | Строка | Должен существовать в таблице authors
            'author_id' => ['sometimes', 'string', 'exists:authors,id'],
            // Не обязательно, но если оно есть в запросе, будет проверено | Массив | Минимум 1
            'genres' => ['sometimes', 'array', 'min:1'],
            // Целое число | Должен существовать в таблице genres
            'genres.*' => ['integer', 'exists:genres,id'],
        ];
    }
}
