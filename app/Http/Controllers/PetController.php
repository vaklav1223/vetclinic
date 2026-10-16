<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PetController extends Controller
{

    public function index()
    {
        $items = DB::table('pets')
            ->leftJoin('owners', 'pets.owner_id', '=', 'owners.id')
            ->select('pets.*', 'owners.name as owner_name')
            ->get();

        return view('catalog', compact('items'));
    }

    public function show(int $id)
    {
        $book = DB::table('pets')
            ->leftJoin('owners', 'pets.owner_id', '=', 'owners.id')
            ->select('pets.*', 'owners.name as owner_name')
            ->where('pets.id', $id)
            ->first(); 
        abort_if(!$book, 404, 'Питомец не найден');

        return view('pet', [
            'id' => $id,
            'book' => $book
        ]);
    }
}