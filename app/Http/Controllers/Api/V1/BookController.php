<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Owner;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'q'         => 'nullable|string|max:255',
            'owner_id'  => 'nullable|integer|exists:owners,id', 
            'sort'      => 'nullable|string|in:title,-title,created_at,-created_at,id,-id', 
            'per_page'  => 'nullable|integer|between:1,50', 
            'min'       => 'nullable|numeric|min:0',
            'max'       => 'nullable|numeric|after_or_equal:min',
        ]);

        $query = Pet::query();

        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }

        if ($request->filled('owner_id')) {
            $query->where('owner_id', $request->owner_id);
        }

        if ($request->filled('min')) {
            $query->where('price', '>=', $request->min);
        }

        if ($request->filled('max')) {
            $query->where('price', '<=', $request->max);
        }

        if ($request->filled('sort')) {
            $sortParam = $request->sort;
            if (str_starts_with($sortParam, '-')) {
                $column = substr($sortParam, 1);
                $direction = 'desc';
            } else {
                $column = $sortParam;
                $direction = 'asc';
            }
            $query->orderBy($column, $direction);
        } else {
            $query->orderBy('id', 'desc'); 
        }

        $perPage = $request->get('per_page', 15);

        return BookResource::collection($query->paginate($perPage));
    }

    public function show(string $id)
    {
        $pet = Pet::with('owner')->find($id);

        if (!$pet) {
            return response()->json(['message' => 'Питомец не найден'], 404);
        }

        return new BookResource($pet);
    }

    public function random()
    {
        $pet = Pet::inRandomOrder()->first();

        if (!$pet) {
            return response()->json(['message' => 'Записи отсутствуют'], 404);
        }

        return new BookResource($pet);
    }

    public function stats()
    {
        $stats = Cache::remember('api_stats', 300, function () {
            return [
                'total_count' => Pet::count(),
                'last_added_at' => Pet::latest()->first()?->created_at?->toIso8601String(),
                'by_genres' => Owner::withCount('pets')->get()->map(function ($owner) {
                    return [
                        'genre_id' => $owner->id,
                        'genre_name' => $owner->name ?? $owner->title ?? '',
                        'count' => $owner->pets_count
                    ];
                })
            ];
        });

        return response()->json($stats);
    }
}
