@extends('layouts.app')

@section('title', 'Modification d\'un utilisateur')

@section('content')

    <form method="post" class="form" action="{{ route('users.update', $user->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="name">Nom :</label>
            <input type="text" class="form-control" name="name" value="{{ $user->name }}"/>
        </div>
        <div class="form-group">
            <label for="first_name">Prénom :</label>
            <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}"/>
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="text" class="form-control" name="email" value="{{ $user->email }}"/>
        </div>
        <div class="form-group">
            <label for="bio">Bio :</label>
            <input type="text" class="form-control" name="bio" value="{{ $user->bio }}"/>
        </div>
        <button type="submit" class="btn btn-primary">Valider</button>
    </form>

@endsection
