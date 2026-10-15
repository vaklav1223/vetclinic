<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $items = config('catalog.items') ?? [];
        return view('welcom', compact('items'));
    }

    public function about()
    {
        $data = [
            'fio' => 'Варлаков Сергей', 
            'group' => '3ПОВТ24Б',
            'description' => 'Проект представляет собой веб-приложение для ветеринарной клиники. Оно позволяет вести учет питомцев, управлять записями к врачам и отслеживать историю лечения пациентов.'
        ];
        return view('about', $data);
    }

    public function contacts()
    {
        $contacts = [
            'address' => 'г. костанай, ул. Ветеринарная, д. 10',
            'phone' => '+7 (495) 123-45-67',
            'email' => 'info@vetclinic-example.ru'
        ];
        return view('contacts', $contacts);
    }

    public function rules()
    {
        $prav = [
            'prav' => 'правил нет кайфуйте',
        ];
        return view('prav', $prav);
    }
}
