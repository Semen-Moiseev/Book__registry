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
            //Валидация: не пустое, Тип данных, Длина не больше 255, Имя уникально
            'name'  => ['required', 'string', 'max:255', 'unique:authors,name'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'  => 'The name is required.',
        ];
    }
}
