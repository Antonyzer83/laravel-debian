@extends('layouts.app')

@section('title', 'Affichage d\'un utilisateur')

@section('content')

    <p>ID : {{ $user->id }}</p>
    <p>Nom entier : {{ $user->name }}</p>
    <p>Nom de famille : {{ $user->last_name }}</p>
    <p>Prénom : {{ $user->first_name }}</p>
    <p>Email : {{ $user->email }}</p>
    <p>Bio : {{ $user->bio }}</p>

@endsection
