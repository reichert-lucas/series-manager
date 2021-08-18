<?php

namespace App\Http\Controllers\Series;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Series\StoreRequest;
use App\Models\Serie;
use Illuminate\Http\Request;

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

    public function store(StoreRequest $request)
    {
        
        $serie = Serie::create($request->all());

        $request->session()->flash( // message só vai aparecer uma vez
            'message',
            'Série CRIADA com Sucesso'
        );
        return redirect()->route('series.index');
        //return redirect()->route('series.index')->with(['messsage' => 'Série criada com Sucesso']);
    }

    public function edit(Serie $serie)
    {
        return view('series.edit');
    }

    public function update(Serie $serie, Request $request)
    {
        return view('series.edit');
    }

    public function destroy(Serie $serie, Request $request)
    {

        $serie->delete();

        $request->session()->flash( // message só vai aparecer uma vez
            'message',
            'Série DELETADA com Sucesso'
        );

        return redirect()->route('series.index');
    }
}
