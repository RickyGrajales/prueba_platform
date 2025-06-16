<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\EncuestaController;

class EliminarPreguntasAntiguas extends Command
{
    protected $signature = 'preguntas:eliminar-antiguas';
    protected $description = 'Elimina preguntas que tengan más de 4 meses';

    public function handle()
    {
        $controller = new EncuestaController();
        $controller->eliminarPreguntasAntiguas();
        $this->info('Preguntas antiguas eliminadas exitosamente.');
    }
}
