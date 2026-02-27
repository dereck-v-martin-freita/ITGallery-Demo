<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use Illuminate\Http\Request;

class FichaController extends Controller
{
    // /ficha  -> LISTADO (1ª imagen)
    public function list(Request $request)
    {
        $perPage = (int) $request->input('per_page', 15);
        if ($perPage < 5) $perPage = 5;
        if ($perPage > 100) $perPage = 100;

        $query = Obra::query();

        $q = trim((string) $request->input('q', ''));
        if ($q !== '') {
            $query->where(function ($sub) use ($q) {
                $sub->where('titulo', 'like', "%{$q}%")
                    ->orWhere('artista', 'like', "%{$q}%")
                    ->orWhere('inventario', 'like', "%{$q}%");
            });
        }

        $artist = trim((string) $request->input('artist', ''));
        if ($artist !== '') {
            $query->where('artista', 'like', "%{$artist}%");
        }

        $inventory = trim((string) $request->input('inventory', ''));
        if ($inventory !== '') {
            $query->where('inventario', 'like', "%{$inventory}%");
        }

        $yearFrom = $request->input('year_from');
        if ($yearFrom !== null && $yearFrom !== '') {
            $query->where('anio', '>=', (int) $yearFrom);
        }

        $yearTo = $request->input('year_to');
        if ($yearTo !== null && $yearTo !== '') {
            $query->where('anio', '<=', (int) $yearTo);
        }

        $hasImage = (string) $request->input('has_image', '');
        if ($hasImage === '1') {
            $query->whereNotNull('imagen')->where('imagen', '!=', '');
        } elseif ($hasImage === '0') {
            $query->where(function ($sub) {
                $sub->whereNull('imagen')->orWhere('imagen', '=', '');
            });
        }

        $obras = $query->orderByDesc('id')->paginate($perPage)->withQueryString();

        return view('ficha_listado', compact('obras'));
    }

    // /ficha/{id} -> DETALLE (2ª imagen) (lo que ya tenías)
    public function index($id)
    {
        $obra = Obra::findOrFail($id);
        return view('ficha', compact('obra', 'id'));
    }
}