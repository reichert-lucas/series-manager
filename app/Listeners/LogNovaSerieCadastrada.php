<?php

namespace App\Listeners;

use App\Events\NovaSerie;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogNovaSerieCadastrada implements ShouldQueue // ShouldQueue vai enviar este listener para fila
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NovaSerie  $event
     * @return void
     */
    public function handle(NovaSerie $event)
    {
        Log::info(
            "
            Nome da Série: $event->nomeSerie 
            Quantidade de Temporadas: $event->qtdTemporadas
            Quantidade de Episódios: $event->qtdEpisodios
            "
        );
    }
}
