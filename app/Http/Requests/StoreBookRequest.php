<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            //Валидация: не пустое, тип данных, длина не больше 255
            'title'  => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            //
        ];
    }
}
