<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAuthorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            //Валидация: переменная есть в поле ввода, Тип данных, Длина не больше 255
            'name' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
