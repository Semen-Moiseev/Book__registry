<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\BookType;
use App\Enums\UserRole;

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            // Не обязательно, но если оно есть в запросе, будет проверено | Строка | Входит в enum
            'type' => ['sometimes', 'string', Rule::enum(BookType::class)],
            // Не обязательно, но если оно есть в запросе, будет проверено | Массив | Минимум 1
            'genres' => ['sometimes', 'array', 'min:1'],
            // Целое число | Должен существовать в таблице genres
            'genres.*' => ['integer', 'exists:genres,id'],
        ];

        if(auth()->user()->role === UserRole::AUTHOR)
        {
            // Не обязательно, но если оно есть в запросе, будет проверено | Строка | Длина не больше 255 | Уникальное название только для этого автора
            $rules['title'] = ['sometimes', 'string', 'max:255', Rule::unique('books')->ignore
            ($this->book->id)->where(function ($query) {
                $authorId = $this->user()->author->id;
                return $query->where('author_id', $authorId);
            })];
        }

        if(auth()->user()->role === UserRole::ADMIN)
        {
            // Не обязательно, но если оно есть в запросе, будет проверено | Строка | Длина не больше 255 | Уникальное название только для этого автора
            $rules['title'] = ['sometimes', 'string', 'max:255', Rule::unique('books')->ignore($this->book->id)->where(fn ($query) => $query->where('author_id', $this->input('author_id')))];
            // Не обязательно, но если оно есть в запросе, будет проверено | Строка | Должен существовать в таблице authors
            $rules['author_id'] = ['sometimes', 'string', 'exists:authors,id'];
        }

        return $rules;
    }
}
