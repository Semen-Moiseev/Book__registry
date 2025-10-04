<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGenreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Не обязательно, но если оно есть в запросе, будет проверено | Строка | Длина не больше 255 | Уникально, не сравнивая с текущим
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('genres', 'name')->ignore($this->route('genre'))]
        ];
    }
}
