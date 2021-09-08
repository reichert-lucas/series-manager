<?php

namespace App\Http\Controllers\Series;

use App\Http\Controllers\Controller;
use App\Models\Episodio;
use App\Models\Temporada;
use Illuminate\Http\Request;

class EpisodiosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Temporada $temporada, Request $request)
    {
        $episodios = $temporada->episodios()->get();
        $message = $request->session()->get('message');

        return view('episodios.index', compact('episodios', 'temporada', 'message'));
    }

    public function watch(Request $request, Temporada $temporada)
    {   
        $episodiosAssistidos = $request->episodios;

        $temporada->episodios->each(function (Episodio $episodio) 
        use ($episodiosAssistidos){
            $episodio->assistido = in_array(
                $episodio->id,
                $episodiosAssistidos
            );
        });

        $temporada->push();
        $request->session()->flash('message', 'Episódios marcados como assistidos');

        return redirect()->back();
    }
}
