<?php

namespace App\Listeners;

use App\Events\NovaSerie;
use App\Mail\NovaSerie as MailNovaSerie;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EnviarEmailNovaSerieCadastrada implements ShouldQueue // ShouldQueue vai enviar este listener para fila
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
        foreach (User::all() as $index => $user) { // enviar email para todos os usuários do sistema

            $timeToWait = $index + 1;

            $email = new MailNovaSerie(
                $event->nomeSerie, 
                $event->qtdTemporadas, 
                $event->qtdEpisodios
            );

            $email->subject('Nova Série Adicionada');
        
            $when = now()->addSecond($timeToWait * 10);

            Mail::to($user)->later(
                $when,
                $email
            );
        }
    }
}
