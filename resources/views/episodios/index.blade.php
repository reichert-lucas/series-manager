@extends('layouts.default')

@section('title')
    Episodios da Temporada {{$temporada->name}}
@endsection

@section('content')

    @include('includes.messages', ['message' => $message])    

    <form action="{{route('series.temporadas.episodios.watch', ['temporada' => $temporada->id])}}" method="post">
        @csrf
        <ul class="list-group mb-3">
            @foreach ($episodios as $episodio)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>Episódio {{$episodio->numero}}</div>
                    <input class="form-check-input bg-dark" type="checkbox" name="episodios[]" value="{{$episodio->id}}" {{ $episodio->assistido ? 'checked' : '' }}>
                </li>
            @endforeach
        </ul> 
    
        <button type="submit" class="btn btn-primary">
            Salvar
        </button>
    </form>
    
@endsection
             
