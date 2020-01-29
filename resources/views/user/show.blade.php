@extends('layouts.app')

@section('title', 'Affichage d\'un utilisateur')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <p>ID : {{ $user->id }}</p>
                <p>Nom entier : {{ $user->name }}</p>
                <p>Nom de famille : {{ $user->last_name }}</p>
                <p>Prénom : {{ $user->first_name }}</p>
                <p>Email : {{ $user->email }}</p>
                <p>Bio : {{ $user->bio }}</p>
            </div>

            <div class="col-sm">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Nom</td>
                            <td>Niveau</td>
                        </tr>
                    </thead>
                    <body>
                        @foreach($user->skills as $skill)
                            <tr>
                                <td>{{ $skill->name }} <img src="../skills_img/{{ $skill->logo }}" alt="{{ $skill->name }}"></td>
                                <td>{{ $skill->pivot->level }} / 5</td>
                            </tr>
                        @endforeach
                    </body>
                </table>    
            </div>
        </div>
    </div>

@endsection
