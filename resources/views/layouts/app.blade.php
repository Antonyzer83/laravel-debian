<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
    @component('layouts.components.navbar')
        @slot('name')
            Gestion d'utilisateurs
        @endslot
    @endcomponent
    <div class="container">
        <div class="row">
            <div class="col-sm">
                @section('left')
                    <h2>Liste des routes :</h2>
                    <ul>
                        <li>users.index : users GET,</li>
                        <li>users.store : users POST,</li>
                        <li>users.create : users/create GET</li>
                        <li>users.show : users/{id} GET</li>
                        <li>users.update : users/{id} PUT</li>
                        <li>users.destroy : users/{id} DELETE</li>
                        <li>users.edit : users/{id}/edit GET</li>
                    </ul>
                @show
            </div>

            <div class="col-sm">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
