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
            //Валидация: переменная есть в поле ввода, тип данных строка, длина не больше 255
            'title' => ['sometimes', 'string', 'max:255'],
            //переменная есть в поле ввода, тип данных строка, входит в enum
            'type' => ['sometimes', 'string', Rule::enum(BookType::class)],
        ];
    }
}
