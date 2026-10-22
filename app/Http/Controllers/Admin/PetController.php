<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Owner;
use App\Http\Requests\StorePetRequest;
use App\Http\Requests\UpdatePetRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Jobs\GenerateCatalogPdf; 
use Illuminate\Support\Facades\Cache;

class PetController extends Controller
{
    public function index()
    {
        $page = request('page', 1);
        
        $pets = Cache::remember("admin.stats.page_{$page}", 300, function () {
            return Pet::with(['owner', 'user'])->paginate(15);
        });

        return view('admin.pets', compact('pets'));
    }

    public function create()
    {
        Gate::authorize('create', Pet::class);
        
        $owners = Owner::all();
        
        return view('admin.create', compact('owners'));
    }

    public function store(StorePetRequest $request)
    {
        Gate::authorize('create', Pet::class);

        $validated = $request->validated();

        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('covers', 'public');
            $validated['cover'] = $path;
        }

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments');
            $validated['attachment'] = $path;
        }

        Pet::create($validated + ['user_id' => $request->user()->id]);
        
        Cache::flush();

        return redirect()->route('admin.pets.index');
    }

    public function edit($id)
    {
        $pet = Pet::findOrFail($id);
        
        Gate::authorize('update', $pet);
        
        $owners = Owner::all();
        
        return view('admin.edit', compact('pet', 'owners'));
    }

    public function update(UpdatePetRequest $request, $id)
    {
        $pet = Pet::findOrFail($id);
        
        Gate::authorize('update', $pet);
        
        $data = $request->validated();

        if ($request->has('remove_cover') && $pet->cover) {
            Storage::disk('public')->delete($pet->cover);
            $data['cover'] = null;
        }

        if ($request->hasFile('cover')) {
            if ($pet->cover) {
                Storage::disk('public')->delete($pet->cover);
            }

            $path = $request->file('cover')->store('covers', 'public');
            $data['cover'] = $path;
        }

        if ($request->hasFile('attachment')) {
            if ($pet->attachment) {
                Storage::disk('local')->delete($pet->attachment);
            }
            $path = $request->file('attachment')->store('attachments');
            $data['attachment'] = $path;
        }

        $pet->update($data);
        
        Cache::flush();

        return redirect()->route('admin.pets.index')->with('success', 'Изменения сохранены');
    }

    public function destroy($id)
    {
        $pet = Pet::findOrFail($id);
        
        Gate::authorize('delete', $pet);
        
        $pet->delete();
        
        Cache::flush();
        
        return redirect()->route('admin.pets.index');
    }

    public function generatePdfBackground(Request $request)
    {
        GenerateCatalogPdf::dispatch($request->user());

        return back()->with('success', 'Каталог формируется, вы получите уведомление');
    }

    public function downloadExportFile($file)
    {
        $path = "exports/{$file}";

        if (!Storage::disk('local')->exists($path)) {
            abort(404, 'Файл не найден или еще формируется.');
        }

        return Storage::disk('local')->download($path);
    }
}
