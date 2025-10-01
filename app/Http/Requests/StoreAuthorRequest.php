<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuthorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Обязательно | Строка | Длина не больше 255 | Уникально
            'name'  => ['required', 'string', 'max:255', 'unique:authors,name'],
        ];
    }

    public function messages(): array
    {
        return [
            //
        ];
    }
}
