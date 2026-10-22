<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Owner;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Cache;

class PetController extends Controller
{
    public function index(Request $request)
    {
        $sortWhitelist = ['latest', 'price_asc', 'price_desc'];
        $sort = in_array($request->sort, $sortWhitelist) ? $request->sort : 'latest';
        $q = $request->q;
        $owner = $request->owner;
        $page = $request->page ?? 1;

        $cacheKey = "main.page.{$sort}.q_" . ($q ?? 'none') . ".owner_" . ($owner ?? 'none') . ".page_{$page}";

        $items = Cache::remember($cacheKey, 600, function () use ($sort, $q, $owner) {
            $query = Pet::with('owner')
                ->when($q, function ($query, $searchTerm) {
                    $query->search($searchTerm);
                })
                ->when($owner, function ($query, $ownerId) {
                    $query->where('owner_id', $ownerId);
                });

            if ($sort === 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($sort === 'price_desc') {
                $query->orderBy('price', 'desc');
            } else {
                $query->latest();
            }

            return $query->paginate(9)->withQueryString();
        });

        $ownersForMenu = Cache::remember('genres.menu', 3600, function () {
            return Owner::withCount('pets')->get();
        });

        return view('catalog', compact('items', 'ownersForMenu'));
    }

    public function show(Pet $pet)
    {
        $otherPets = $pet->owner->pets()
            ->where('id', '!=', $pet->id)
            ->take(3)
            ->get();

        return view('pet', compact('pet', 'otherPets'));
    }

    public function pdf(Request $request)
    {
        $query = Pet::with('owner')
            ->when($request->q, function ($q, $searchTerm) {
                $q->search($searchTerm);
            })
            ->when($request->owner, function ($q, $ownerId) {
                $q->where('owner_id', $ownerId);
            });

        if ($request->sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }
        $items = $query->get();
        $pdf = Pdf::loadView('pdf.catalog', compact('items'));
        return $pdf->download('catalog.pdf');
    }
}
