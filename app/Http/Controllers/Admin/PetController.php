<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetController extends Controller
{
    public function index()
    {
        $items = DB::table('pets')->get();

        return view('admin.pets', compact('items'));
    }

    public function create()
    {
        return view('admin.create');
    }
}
