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
    <div class="container">
        <div class="h-100 p-5 text-white bg-dark rounded-3 mb-2 mt-1">
            <h2>Séries - @yield('title')</h2>
        </div>

        @yield('content')

    </div>   
</body>
</html>