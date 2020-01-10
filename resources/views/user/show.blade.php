@extends('layouts.app')

@section('title', 'Affichage d\'un utilisateur')

@section('content')

    <p>{{ $user->id }}</p>
    <p>{{ $user->name }}</p>
    <p>{{ $user->first_name }}</p>
    <p>{{ $user->email }}</p>
    <p>{{ $user->bio }}</p>

@endsection
