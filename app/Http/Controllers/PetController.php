<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $items = config('catalog.items') ?? [];
        return view('catalog', compact('items'));
    }

    public function show(int $id)
    {
        $items = config('catalog.items') ?? [];
        abort_if(!isset($items[$id]), 404, 'Питомец не найден');
        $book = $items[$id];
        return view('pet', [
            'id' => $id,
            'book' => $book
        ]);
    }
}
