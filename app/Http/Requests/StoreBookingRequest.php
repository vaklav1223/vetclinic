<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'pet_name' => ['required', 'string', 'max:255'],
            'pet_breed' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^\+7\d{10}$/'],
            'comment' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'pet_name.required' => 'Введите кличку питомца.',
            'pet_breed.required' => 'Введите породу питомца.',
            'phone.required' => 'Поле телефона обязательно.',
            'phone.regex' => 'Формат телефона должен быть +7XXXXXXXXXX',
        ];
    }
}
