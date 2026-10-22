<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use App\Http\Resources\GenreResource;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $owners = Owner::withCount('pets')->get();

        return GenreResource::collection($owners);
    }

    public function books(string $id, Request $request)
    {
        $owner = Owner::find($id);

        if (!$owner) {
            return response()->json(['message' => 'Владелец не найден'], 404);
        }

        $perPage = $request->get('per_page', 15);
        $pets = $owner->pets()->paginate($perPage);

        return GenreResource::collection($pets);
    }
}
