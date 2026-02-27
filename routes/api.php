<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ObraController;

Route::get('/obra/{id}', [ObraController::class, 'show']);
Route::put('/obra/{id}', [ObraController::class, 'update']);
Route::post('/obra/{id}', [ObraController::class, 'update']); // para multipart + _method