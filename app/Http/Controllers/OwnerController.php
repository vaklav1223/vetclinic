<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function show(Owner $owner)
    {
        $owner->load('pets');
        return view('owner', compact('owner'));
    }
}
