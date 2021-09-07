@extends('layouts.default')

@section('title')
    Temporadas de {{$serie->name}}
@endsection

@section('content')

    <ul class="list-group">
        @foreach ($temporadas as $temporada)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{ route('series.temporadas.episodios.index', ['temporada' => $temporada->id]) }}">
                    Temporada {{$temporada->numero}}
                </a>
                <span class="badge bg-dark">
                    {{$temporada->getEpisodiosAssistidos()->count()}} / {{$temporada->episodios()->count()}}
                </span>
            </li>
        @endforeach
    </ul>   
    
@endsection
             
