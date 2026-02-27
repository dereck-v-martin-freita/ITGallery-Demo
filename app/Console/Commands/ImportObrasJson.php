<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Obra;

class ImportObrasJson extends Command
{
    protected $signature = 'obras:import
        {path : Ruta del JSON relativa a la raíz del proyecto (ej: storage/obrasdearte.json)}
        {--truncate : Vacía la tabla antes de importar}';

    protected $description = 'Importa obras desde un JSON a la tabla obras';

    public function handle()
    {
        $path = (string) $this->argument('path');
        $fullPath = base_path($path);

        if (!file_exists($fullPath)) {
            $this->error("No existe: {$fullPath}");
            $this->line("Ejemplos:");
            $this->line("  php artisan obras:import storage/obrasdearte.json");
            $this->line("  php artisan obras:import storage/obrasdeartejson");
            return self::FAILURE;
        }

        $raw = file_get_contents($fullPath);
        $data = json_decode($raw, true);

        if (!is_array($data)) {
            $this->error("JSON inválido en: {$fullPath}");
            return self::FAILURE;
        }

        if ($this->option('truncate')) {
            Obra::truncate();
        }

        $count = 0;

        foreach ($data as $i => $row) {
            if (
                !is_array($row) ||
                !isset($row['id'], $row['titulo'], $row['artista'], $row['año'], $row['inventario'], $row['tamaño'], $row['imagen'])
            ) {
                $this->error("Fila {$i} inválida: faltan campos (id,titulo,artista,año,inventario,tamaño,imagen).");
                return self::FAILURE;
            }

            Obra::updateOrCreate(
                ['id' => (int) $row['id']],
                [
                    'titulo' => (string) $row['titulo'],
                    'artista' => (string) $row['artista'],
                    'anio' => (int) $row['año'],
                    'inventario' => (string) $row['inventario'],
                    'tamano' => (string) $row['tamaño'],
                    'imagen' => (string) $row['imagen'],
                ]
            );

            $count++;
        }

        $this->info("Importadas/actualizadas: {$count}");
        return self::SUCCESS;
    }
}