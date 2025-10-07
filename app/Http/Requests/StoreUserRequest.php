<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            // Обязательно | Email | Уникальный в таблице users
            'email' => ['required', 'email', 'unique:users,email'],
            // Обязательно | Строка | Минимум 6 символов | Подтвержден
            'password' => ['required', 'string', 'min:6', 'confirmed']
        ];
    }
}
