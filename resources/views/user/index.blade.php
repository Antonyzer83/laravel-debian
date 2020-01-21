@extends('layouts.app')

@section('title', 'Liste des utilisateurs')

@section('content')

    <table class="table">
        <thead>
            <tr>
                <td>ID</td>
                <td>Nom entier</td>
                <td>Nom</td>
                <td>Prénom</td>
                <td>Rôle</td>
                <td>Email</td>
                <td>Bio</td>
                <td>Compétences</td>
                @if(Auth::check())
                    <td colspan="3">Actions</td>
                @endif
            </tr>
        </thead>
        <body>
            @foreach($users as $user)
                <tr @if(Auth::check()) @if(Auth::user()->id == $user->id) style="color: red;" @endif @endif>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->bio }}</td>
                    <td>
                        <ul class="list-group list-group-flush">
                        @foreach($user->skills as $skill)
                                <li class="list-group-item"><img src="skills_img/{{ $skill->logo }}" alt="{{ $skill->name }}"> {{ $skill->name }} : {{ $skill->pivot->level }} / 5</li>
                        @endforeach
                        </ul>
                    </td>
                    @if(Auth::check())
                        @if(Auth::user()->id === $user->id || Auth::user()->status === 1)
                            <td><a href="{{ route('users.show', $user->id) }}" class="btn btn-info">Voir</a>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success">Modifier</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Supprimer</button>
                            </form>
                            </td>
                        @endif
                    @endif
                </tr>
            @endforeach
        </body>
    </table>

@endsection
