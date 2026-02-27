<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtworkManageController;
use App\Http\Controllers\FichaController;
use App\Models\Obra;

// Gestión / Galería
Route::get('artworks/gestion', [ArtworkManageController::class, 'index']);
Route::post('artworks', [ArtworkManageController::class, 'store']);
Route::delete('artworks/{id}', [ArtworkManageController::class, 'destroy']);

// Ficha LISTADO (Artworks list)
Route::get('ficha', [FichaController::class, 'list'])->name('ficha.list');

// Ficha DETALLE (Artwork detail)
Route::get('ficha/{id}', [FichaController::class, 'index'])->name('ficha');

// Editar (vista editar.blade.php, sin controlador)
Route::get('editar/{id}', function ($id) {
    $obra = Obra::findOrFail($id);
    return view('editar', compact('obra', 'id'));
})->name('editar');

// Home -> redirige al listado
Route::get('/', function () {
    return redirect()->route('ficha.list');
});