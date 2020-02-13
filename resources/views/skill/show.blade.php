@extends('layouts.app')

@section('title', 'Affichage d\'un utilisateur')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-3">
                <p>ID : {{ $skill->id }}</p>
                <p>Nom : {{ $skill->name }}</p>
                <p>Description : {{ $skill->description }}</p>
                <p>Logo : {{ $skill->logo }}</p>
            </div>
            <div class="col-9">
                <table class="table">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>Nom</td>
                        <td>Compétences</td>
                    </tr>
                    </thead>
                    <body>
                    @foreach($skill->users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a></td>
                            <td>
                                <ul class="list-group list-group-flush">
                                    @foreach($user->skills as $skill)
                                        <li class="list-group-item"><img src="../skills_img/{{ $skill->logo }}" alt="{{ $skill->name }}"> {{ $skill->name }} : {{ $skill->pivot->level }} / 5</li>
                                    @endforeach
                                </ul>
                            </td>
                    @endforeach
                    </body>
                </table>
            </div>
        </div>
    </div>

@endsection
