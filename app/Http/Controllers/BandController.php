<?php

namespace App\Http\Controllers;

use App\Models\Band;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BandController extends Controller
{
    public function index()
    {
        $bandas = Band::withCount('albuns')->get();
        return view('bandas.index_banda', compact('bandas'));
    }

    public function create()
    {
        return view('bandas.create_banda');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('bandas', 'public');
            $validated['image'] = $path;
        }

        Band::create($validated);

        return redirect()->route('bandas.index')->with('success', 'Banda criada com sucesso!');
    }

    public function edit($id)
    {
        $band = Band::findOrFail($id);
        return view('bandas.edit_banda', compact('band'));
    }

    public function update(Request $request, $id)
    {
        $band = Band::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($band->image) {
                Storage::delete('public/' . $band->image);
            }
            // Store new image
            $path = $request->file('image')->store('bandas', 'public');
            $validated['image'] = $path;
        }

        $band->update($validated);

        return redirect()->route('bandas.index')->with('success', 'Banda atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $banda = Band::findOrFail($id);
        if ($banda->image) {
            Storage::delete('public/' . $banda->image);
        }
        $banda->delete();

        return redirect()->route('bandas.index')->with('success', 'Banda deletada com sucesso!');
    }
}
