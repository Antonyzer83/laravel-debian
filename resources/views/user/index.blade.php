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
            </tr>
        </thead>
        <body>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->bio }}</td>
                </tr>
            @endforeach
        </body>
    </table>

@endsection