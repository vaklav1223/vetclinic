<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OwnerController extends Controller
{
    public function index()
    {
        $owners = Owner::with(['user'])->paginate(15);
        return view('admin.owners.index', compact('owners'));
    }

    public function create()
    {
        Gate::authorize('create', Owner::class);
        return view('admin.owners.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Owner::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);

        Owner::create($validated + ['user_id' => $request->user()->id]);

        return redirect()->route('admin.owners.index');
    }

    public function edit($id)
    {
        $owner = Owner::findOrFail($id);
        
        Gate::authorize('update', $owner);

        return view('admin.owners.edit', compact('owner'));
    }

    public function update(Request $request, $id)
    {
        $owner = Owner::findOrFail($id);
        
        Gate::authorize('update', $owner);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);

        $owner->update($validated);

        return redirect()->route('admin.owners.index')->with('success', 'Изменения сохранены');
    }

    public function destroy($id)
    {
        $owner = Owner::findOrFail($id);
        
        Gate::authorize('delete', $owner);

        $owner->delete();

        return redirect()->route('admin.owners.index');
    }
    public function show($id)
{
    $owner = \App\Models\Owner::with('pets')->findOrFail($id);

    return view('owner', compact('owner'));
}

}
