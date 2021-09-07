@extends('layouts.default')

@section('title')
    Séries - Index
@endsection

@section('content')

    @include('includes.messages', ['message' => $message])    

    <a href="{{route('series.create')}}" class="btn btn-dark mb-1">
        <i class="bi bi-plus"></i>
        Adicionar
    </a>

    <ul class="list-group">
        @foreach($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span id="nome-serie-{{ $serie->id }}">{{ $serie->name }}</span>

                <div class="input-group w-50" hidden id="input-nome-serie-{{ $serie->id }}">
                    <input type="text" class="form-control" value="{{ $serie->name }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary bi bi-check2-circle" onclick="editarSerie({{ $serie->id }})"></button>
                        @csrf
                    </div>
                </div>

                <span class="d-flex">
                    <button class="btn btn-sm btn-primary me-1 bi bi-pencil-square" onclick="toggleInput({{ $serie->id }})"></button>
                    <a href="{{ route('series.temporadas.index', ['serie' => $serie->id]) }}" class="btn btn-sm btn-primary me-1">
                        <i class="bi bi-box-arrow-up-right"></i>
                    </a>
                    <form method="post" action="{{route('series.destroy', ['serie' => $serie->id])}}"
                        onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($serie->name) }}?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger bi bi-trash"></button>
                    </form>
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
             
