<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $items = config('catalog.items') ?? [];
        return view('admin.pets', compact('items'));
    }

    public function create()
    {
        return view('admin.create');
    }
}
