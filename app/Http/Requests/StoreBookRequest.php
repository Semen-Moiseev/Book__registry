<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\BookType;

class StoreBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Обязательно | Строка | Длина не больше 255 | Уникальное название только для этого автора
            'title' => ['required', 'string', 'max:255', Rule::unique('books')->where(fn ($query) => $query->where('author_id', $this->input('author_id')))],
            // Обязательно | Строка | Входит в enum
            'type' => ['required', 'string', Rule::enum(BookType::class)],
            // Обязательно | Строка | Должен существовать в таблице authors
            'author_id' => ['required', 'string', 'exists:authors,id'],
            // Обязательно | Массив | Минимум 1
            'genres' => ['required', 'array', 'min:1'],
            // Целое число | Должен существовать в таблице genres
            'genres.*' => ['integer', 'exists:genres,id'],
        ];
    }

    public function messages(): array
    {
        return [
            //
        ];
    }
}
