@extends('layouts.default')

@section('title')
    Séries - Index
@endsection

@section('content')

    @include('includes.messages', ['message' => $message])    

    @auth
        <a href="{{route('series.create')}}" class="btn btn-dark mb-1">
            <i class="bi bi-plus"></i>
            Adicionar
        </a>
    @endauth
    

    <ul class="list-group">
        @foreach($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">

                <div class="d-flex justify-content-start align-items-center w-100">
                    <img src="{{$serie->capa_url}}" alt="Imagem da Série" class="img-thumbnail me-3" height="75px" width="75px">
                    <span id="nome-serie-{{ $serie->id }}"><b>{{ $serie->name }}</b></span>
                    <div class="input-group w-75" hidden id="input-nome-serie-{{ $serie->id }}">
                        <input type="text" class="form-control" value="{{ $serie->name }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary bi bi-check2-circle" onclick="editarSerie({{ $serie->id }})"></button>
                            @csrf
                        </div>
                    </div>
                </div>

                <span class="d-flex">
                    @auth
                        <button class="btn btn-sm btn-primary me-1 bi bi-pencil-square" onclick="toggleInput({{ $serie->id }})"></button>
                    @endauth
                    <a href="{{ route('series.temporadas.index', ['serie' => $serie->id]) }}" class="btn btn-sm btn-primary me-1">
                        <i class="bi bi-box-arrow-up-right"></i>
                    </a>
                    @auth
                        <form method="post" action="{{route('series.destroy', ['serie' => $serie->id])}}"
                            onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($serie->name) }}?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger bi bi-trash"></button>
                        </form>
                    @endauth
                </span>
            </li>
        @endforeach
    </ul>  
    
    <script>
        function toggleInput(serieId) {
            const nomeSerieEl = document.getElementById(`nome-serie-${serieId}`);
            const inputSerieEl = document.getElementById(`input-nome-serie-${serieId}`);
            if (nomeSerieEl.hasAttribute('hidden')) {
                nomeSerieEl.removeAttribute('hidden');
                inputSerieEl.hidden = true;
            } else {
                inputSerieEl.removeAttribute('hidden');
                nomeSerieEl.hidden = true;
            }
        }

        function editarSerie(serieId) {
            let formData = new FormData();
            const nome = document
                .querySelector(`#input-nome-serie-${serieId} > input`)
                .value;
            const token = document
                .querySelector(`input[name="_token"]`)
                .value;
            formData.append('nome', nome);
            formData.append('_token', token);
            const url = `/series/${serieId}/updateName`;
            fetch(url, {
                method: 'POST',
                body: formData
            }).then(() => {
                toggleInput(serieId);
                document.getElementById(`nome-serie-${serieId}`).textContent = nome;
            });
        }

    </script> 
@endsection
             
