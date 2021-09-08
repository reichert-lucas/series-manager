<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Séries - @yield('title')</title>
    <link rel="stylesheet" href={{asset('css/app.css')}}>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container-md d-flex justify-content-between">
            <a class="navbar-brand" href="{{route('series.index')}}">Navbar</a>
            <div>
                @auth
                    <a class="navbar-brand" href="{{ route('sair') }}">Sair</a>
                @endauth
                @guest
                    <a class="navbar-brand" href="{{ route('entrar.index') }}">Entrar</a>
                @endguest

            </div>
        </div>
    </nav>

    <div class="container mb-4">
        <div class="h-100 p-5 text-white bg-dark rounded-3 mb-2 mt-1">
            <h2>@yield('title')</h2>
        </div>

        @yield('content')

    </div>   
</body>
</html>