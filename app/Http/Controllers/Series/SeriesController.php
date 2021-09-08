<?php

namespace App\Http\Controllers\Series;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Series\StoreRequest;
use App\Mail\NovaSerie;
use App\Models\Episodio;
use App\Models\Serie;
use App\Models\Temporada;
use App\Models\User;
use App\Services\SeriesCreator;
use App\Services\SeriesRemover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SeriesController extends Controller
{    
    public function index(Request $request) 
    {
        $series = Serie::orderBy('name')->get();

        $message = $request->session()->get('message');
        
        return view('series.index', [
            'series' => $series,
            'message' => $message,
        ]);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(StoreRequest $request, SeriesCreator $seriesCreator)
    {
        $serie = $seriesCreator->createSerie(
            $request->name, 
            $request->qtd_temporadas, 
            $request->ep_por_temporada
        );

        foreach (User::all() as $index => $user) { // enviar email para todos os usuários do sistema

            $timeToWait = $index + 1;

            $email = new NovaSerie(
                $request->name, 
                $request->qtd_temporadas, 
                $request->ep_por_temporada
            );
        
            $email->subject('Nova Série Adicionada');
        
            $when = now()->addSecond($timeToWait * 10);

            Mail::to($user)->later(
                $when,
                $email
            );

            //sleep(5); // espera um tempo para não ser bloquado por fazer muitas requisições
        }

        $request->session()->flash( // message só vai aparecer uma vez
            'message',
            "Série {$serie->name} e suas temporadas foram CRIADAS com Sucesso"
        );

        return redirect()->route('series.index');
    }

    public function edit(Serie $serie)
    {
        return view('series.edit');
    }

    public function update(Serie $serie, Request $request)
    {
        return view('series.edit');
    }

    public function destroy(Serie $serie, Request $request, SeriesRemover $seriesRemover)
    {

        $serieName = $seriesRemover->removeSerie($serie);
        
        $request->session()->flash( // message só vai aparecer uma vez
            'message',
            "Série {$serieName} DELETADA com Sucesso"
        );
        
        return redirect()->route('series.index');
    }

    public function updateName(Request $request, Serie $serie)
    {
        $serie->update([
            'name' => $request->nome
        ]);
    }

}
