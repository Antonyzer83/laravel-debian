@extends('layouts.app')

@section('title', 'Création d\'utilisateur')

@section('content')

    <form method="post" class="form" action="{{ route('skills.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nom :</label>
            <input type="text" class="form-control" name="name"/>
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <input type="text" class="form-control" name="description"/>
        </div>
        <div class="form-group">
            <label for="logo">Logo :</label>
            <input type="file" class="form-control" name="logo"/>
        </div>
        <button type="submit" class="btn btn-primary">Valider</button>
    </form>

@endsection
