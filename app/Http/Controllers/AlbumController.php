<?php

namespace App\Http\Controllers;

use App\Models\Band;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    public function view($id)
    {
        $band = Band::findOrFail($id);
        $albuns = $band->albuns()->orderBy('release_date', 'desc')->get();
        return view('albuns.view_albuns', compact('band', 'albuns'));
    }

    public function create($id)
    {
        $band = Band::findOrFail($id);

        $albuns = $band->albuns()->orderBy('release_date', 'desc')->get();
        return view('albuns.create_albuns', compact('band', 'albuns'));
    }

    public function store(Request $request, Band $band)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'release_date' => 'required|date',
        ]);

        $albumData = $request->only(['name', 'release_date', 'band_id']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('albuns', 'public');
            $albumData['image'] = $path;
        }

        Album::create($albumData);

        return redirect()->route('albuns.view', $albumData['band_id'])
            ->with('success', 'Álbum criado com sucesso!');
    }

    public function edit($id)
    {
        $album = Album::findOrFail($id);
        $band = $album->band;
        return view('albuns.edit_albuns', compact('band', 'album'));
    }

    public function update(Request $request, $id)
    {
        try {
            $album = Album::findOrFail($id);
            $band = $album->band;

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'release_date' => 'required|date',
            ]);

            if ($request->hasFile('image')) {
                if ($album->image) {
                    Storage::disk('public')->delete($album->image);
                }
                $validated['image'] = $request->file('image')->store('albuns', 'public');
            }

            $album->update($validated);

            return redirect()->route('albuns.view', $band->id)
                ->with('success', 'Álbum atualizado com sucesso!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Erro ao atualizar álbum: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $album = Album::findOrFail($id);
        $band = $album->band;

        try {
            if ($album->image) {
                Storage::disk('public')->delete($album->image);
            }

            $album->delete();

            return redirect()->route('albuns.view', $band)
                ->with('success', 'Álbum removido com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('albuns.view', $band)
                ->with('error', 'Erro ao remover o álbum.');
        }
    }
}
