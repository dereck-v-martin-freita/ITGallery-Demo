<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obra extends Model
{
    protected $table = 'obras';
    public $incrementing = true;   // <-- importante
    protected $keyType = 'int';

    protected $fillable = [
        'titulo','artista','anio','inventario','tamano','imagen'
    ];
}