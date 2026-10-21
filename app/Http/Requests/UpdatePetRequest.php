<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_vaccinated' => $this->has('is_vaccinated'),
        ]);
    }

    public function rules(): array
    {
        return [
            'title'       => 'required|string|min:2|max:100',
            'breed'       => 'required|string|max:50|in:Беспородная,Сиамская,Персидская,Овчарка,Лабрадор,Метис,Мейн-кун,Британская,Сфинкс,Хаски,Мопс,Чихуахуа,Пудель',
            'age'         => 'required|integer|between:0,30',
            'price'       => 'required|numeric|min:0|max:100000',
            'owner_id'    => 'required|exists:owners,id',
            'description' => 'nullable|string|max:1000',
            'is_vaccinated'  => 'required|boolean',
            'cover'       => ['nullable', 'image', 'max:2048'],
            'remove_cover' => ['nullable', 'boolean'],
            'attachment' => ['nullable', 'mimes:pdf,docx,doc,xls,xlsx,txt,png,jpg,jpeg', 'max:10240'],

        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Пожалуйста, укажите кличку питомца.',
            'title.unique'   => 'Питомец с такой кличкой уже зарегистрирован в клинике.',
            'breed.required' => 'Порода обязательна для заполнения.',
            'breed.in'       => 'Выбранная порода отсутствует в списке разрешенных.',
            'age.required'   => 'укажите возраст',
            'age.between'    => 'Возраст должен быть в диапазоне от 0 до 30 лет.',
            'price.required' => 'Укажите цену.',
            'owner_id.required' => 'Укажите владельца',
            'owner_id.exists'=> 'Выбранный владелец не найден в базе данных.',
            'cover.image'    => 'Файл должен быть изображением (jpeg, png, bmp, gif, svg или webp).',
            'cover.max'      => 'Размер изображения не должен превышать 2 МБ.',
            'remove_cover.boolean' => 'Некорректное значение для удаления обложки.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title'       => 'Кличка',
            'breed'       => 'Порода',
            'age'         => 'Возраст',
            'price'       => 'Цена',
            'owner_id'    => 'Владелец',
            'description' => 'Описание',
            'is_vaccinated'  => 'Здоровье',
            'cover'       => 'Обложка', 
            'remove_cover' => 'Удаление обложки',
        ];
    }
}
