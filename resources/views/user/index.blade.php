@extends('layouts.app')

@section('title', 'Liste des utilisateurs')

@section('content')

    <table class="table">
        <thead>
            <tr>
                <td>ID</td>
                <td>Nom</td>
                <td>Prénom</td>
                <td>Email</td>
                <td>Bio</td>
                <td>Actions</td>
            </tr>
        </thead>
        <body>
            @foreach($users as $user)
                <tr @if(Auth::user()->id == $user->id) style="color: red;" @endif>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->bio }}</td>
                    <td><a href="{{ route('users.show', $user->id) }}" class="btn btn-info">Voir</a></td>
                    <td><a href="{{ route('users.edit', $user->id) }}" class="btn btn-success">Modifier</a></td>
                    <td>
                        <form action="{{ route('users.destroy', $user->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </body>
    </table>

@endsection
