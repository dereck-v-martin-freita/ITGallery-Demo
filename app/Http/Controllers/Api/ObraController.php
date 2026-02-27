<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Obra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ObraController extends Controller
{
    public function show($id)
    {
        $obra = Obra::find($id);

        if (!$obra) {
            return response()->json(['error' => 'No encontrada'], 404);
        }

        return response()->json($obra);
    }

    public function update(Request $request, $id)
    {
        $obra = Obra::find($id);

        if (!$obra) {
            return response()->json(['error' => 'No encontrada'], 404);
        }

        $request->validate([
            'titulo' => 'sometimes|nullable|string|max:255',
            'artista' => 'sometimes|nullable|string|max:255',
            'anio' => 'sometimes|nullable|integer',
            'año' => 'sometimes|nullable|integer',
            'inventario' => 'sometimes|nullable|string|max:255',
            'tamano' => 'sometimes|nullable|string|max:255',
            'tamaño' => 'sometimes|nullable|string|max:255',
            'imagen' => 'sometimes|file|image|max:4096', // KB
        ]);

        $obra->titulo = $request->input('titulo', $obra->titulo);
        $obra->artista = $request->input('artista', $obra->artista);
        $obra->inventario = $request->input('inventario', $obra->inventario);

        $anio = $request->input('anio', $request->input('año', null));
        if ($anio !== null) $obra->anio = (int) $anio;

        $tam = $request->input('tamano', $request->input('tamaño', null));
        if ($tam !== null) $obra->tamano = $tam;

        if ($request->hasFile('imagen')) {
            if (!empty($obra->imagen)) {
                Storage::disk('public')->delete('imagenes/' . $obra->imagen);
            }

            $file = $request->file('imagen');
            $extension = $file->getClientOriginalExtension();
            $nombre = 'obra' . $id . '_' . time() . '.' . $extension;

            $file->storeAs('imagenes', $nombre, 'public');
            $obra->imagen = $nombre;
        }

        $obra->save();

        return response()->json(['success' => true, 'obra' => $obra]);
    }
}