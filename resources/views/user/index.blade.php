@extends('layouts.app')

@section('title', 'Utilisateurs')

@section('left')
    @parent
    <p>Child left</p>
@endsection

@section('content')
    <p>Liste des utilisateurs</p>

    @foreach($users as $user)
        <li>{{ $user[0] }}</li>
    @endforeach

    <form method="post" class="form" action="{{ route('jsp') }}">
        @csrf
        <div class="form-group">
            <label for="first_name">Firstname :</label>
            <input type="text" class="form-control" name="first_name"/>
        </div>
        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
@endsection
