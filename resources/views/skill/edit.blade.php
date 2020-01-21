@extends('layouts.app')

@section('title', 'Modification d\'un utilisateur')

@section('content')

    <form method="post" class="form" action="{{ route('skills.update', $skill->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="name">Nom :</label>
            <input type="text" class="form-control" name="name" value="{{ $skill->name }}"/>
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <input type="text" class="form-control" name="description" value="{{ $skill->description }}"/>
        </div>
        <div class="form-group">
            <label for="logo">Logo :</label>
            <input type="file" class="form-control" name="logo" value="{{ $skill->logo }}"/>
        </div>
        <button type="submit" class="btn btn-primary">Valider</button>
    </form>

@endsection
