@extends('layouts.default')

@section('title')
    Temporadas de {{$serie->name}}
@endsection

@section('content')

    @if ($serie->capa)
        <div class="d-flex justify-content-center align-items-center mb-3">
            <a href="{{$serie->capa_url}}" target="_blank" class="btn">
                <img src="{{$serie->capa_url}}" alt="Imagem da Série" class="img-thumbnail me-3" height="350px" width="350px">
            </a>
        </div>
    @endif
    
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
             
