@extends('layouts.app')

@section('title', 'Création d\'utilisateur')

@section('content')

    <form method="post" class="form" action="{{ route('users.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Nom :</label>
            <input type="text" class="form-control" name="name"/>
        </div>
        <div class="form-group">
            <label for="first_name">Prénom :</label>
            <input type="text" class="form-control" name="first_name"/>
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="text" class="form-control" name="email"/>
        </div>
        <div class="form-group">
            <label for="bio">Bio :</label>
            <input type="text" class="form-control" name="bio"/>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" class="form-control" name="password"/>
        </div>
        <div class="form-group">
            <label for="c_password">Confirmation du mot de passe :</label>
            <input type="password" class="form-control" name="c_password"/>
        </div>
        <button type="submit" class="btn btn-primary">Valider</button>
    </form>

@endsection
