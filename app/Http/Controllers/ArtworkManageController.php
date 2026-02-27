<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtworkManageController extends Controller
{
    public function index()
    {
        $obras = Obra::orderByDesc('id')->get();
        return view('artworks.gestion', compact('obras'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'artista' => ['required', 'string', 'max:255'],
            'inventario' => ['required', 'string', 'max:255'],
            'anio' => ['nullable', 'integer'],
            'tamano' => ['nullable', 'string', 'max:255'],
            'imagen' => ['nullable', 'file', 'image', 'max:4096'],
        ]);

        $obra = new Obra();
        $obra->titulo = $data['titulo'];
        $obra->artista = $data['artista'];
        $obra->inventario = $data['inventario'];
        $obra->anio = isset($data['anio']) ? (int) $data['anio'] : null;
        $obra->tamano = $data['tamano'] ?? null;

        // Guardamos primero para tener ID (si imagen viene después)
        $obra->save();

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $extension = $file->getClientOriginalExtension();
            $nombre = 'obra_' . $obra->id . '_' . time() . '.' . $extension;

            $file->storeAs('imagenes', $nombre, 'public');

            $obra->imagen = $nombre;
            $obra->save();
        }

        return redirect(url('artworks/gestion'))->with('success', 'Obra creada correctamente.');
    }

    public function destroy($id)
    {
        $obra = Obra::findOrFail($id);

        if (!empty($obra->imagen)) {
            Storage::disk('public')->delete('imagenes/' . $obra->imagen);
        }

        $obra->delete();

        return redirect(url('artworks/gestion'))->with('success', 'Obra eliminada correctamente.');
    }
}