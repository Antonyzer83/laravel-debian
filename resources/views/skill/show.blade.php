@extends('layouts.app')

@section('title', 'Affichage d\'un utilisateur')

@section('content')

    <p>ID : {{ $skill->id }}</p>
    <p>Nom : {{ $skill->name }}</p>
    <p>Description : {{ $skill->description }}</p>

@endsection
