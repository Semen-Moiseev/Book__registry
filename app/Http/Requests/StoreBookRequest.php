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
            //Валидация: не пустое, тип данных строка, длина не больше 255
            'title'  => ['required', 'string', 'max:255'],
            //не пустое, тип данных строка, входит в enum
            'type' => ['required', 'string', Rule::enum(BookType::class)],
        ];
    }

    public function messages(): array
    {
        return [
            //
        ];
    }
}
