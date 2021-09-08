@extends('layouts.default')

@section('title')
    Criar
@endsection

@section('content')

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{route('series.store')}}" method="post" enctype="multipart/form-data" class="container mt-4">
        @csrf

        <div class="mb-3">
            <div class="row">
                <div class="col col-8">
                    <label class="form-label">Nome</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="col col-2">
                    <label class="form-label">Nº de temporadas</label>
                    <input type="number" name="qtd_temporadas" class="form-control">
                </div>
                <div class="col col-2">
                    <label class="form-label">Ep. por temporada</label>
                    <input type="number" name="ep_por_temporada" class="form-control">
                </div>

            </div>   
            <div class="row mt-3">
                <label class="form-label" for="capa">Capa</label>
                <input type="file" name="capa">
            </div>            
        </div>

        <button type="submit" class="btn btn-primary">Criar</button>
    </form>
@endsection
             
