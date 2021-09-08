<?php

namespace App\Http\Controllers\Series;

use App\Http\Controllers\Controller;
use App\Models\Serie;
use Illuminate\Http\Request;

class TemporadasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Serie $serie)
    {
        $temporadas = $serie->temporadas()->get();

        return view('temporadas.index', compact('temporadas', 'serie'));
    }
}
