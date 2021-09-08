<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NovaSerie extends Mailable
{
    use Queueable, SerializesModels;

    public $nome;
    public $qtdTemporadas;
    public $qtdEpisodios;

    public function __construct($nome, $qtdTemporadas, $qtdEpisodios)
    {
        $this->nome = $nome;
        $this->qtdTemporadas = $qtdTemporadas;
        $this->qtdEpisodios = $qtdEpisodios;
    }

    public function build()
    {
        return $this->view('mail.serie.nova-serie');
    }
}
