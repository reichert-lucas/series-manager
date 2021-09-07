@extends('layouts.default')

@section('title')
    Temporadas de {{$serie->name}}
@endsection

@section('content')

    <ul class="list-group">
        @foreach ($temporadas as $temporada)
            <li class="list-group-item">
                Temporada {{$temporada->numero}}
            </li>
        @endforeach
    </ul>   
    
@endsection
             
