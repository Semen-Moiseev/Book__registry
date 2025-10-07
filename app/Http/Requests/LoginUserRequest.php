<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Обязательно | Email | Максимальная длина 255
            'email' => ['required', 'email', 'max:255'],
            // Обязательно | Строка | Минимум 6 символов
            'password' => ['required', 'string', 'min:6'],
        ];
    }
}
