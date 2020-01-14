@extends('layouts.app')

@section('title', 'Liste des compétences')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <td>ID</td>
                <td>Nom</td>
                <td>Description</td>
                <td>Logo</td>
                @if(Auth::check())
                    @if(Auth::user()->status === 1)
                        <td colspan="3">Actions</td>
                    @endif
                @endif
            </tr>
        </thead>
        <body>
            @foreach($skills as $skill)
                <tr>
                    <td>{{ $skill->id }}</td>
                    <td>{{ $skill->name }}</td>
                    <td>{{ $skill->description }}</td>
                    <td>{{ $skill->logo }}</td>
                    @if(Auth::check())
                        @if(Auth::user()->status === 1)
                            <td><a href="{{ route('skills.show', $skill->id) }}" class="btn btn-info">Voir</a></td>
                            <td><a href="{{ route('skills.edit', $skill->id) }}" class="btn btn-success">Modifier</a></td>
                            <td>
                                <form action="{{ route('skills.destroy', $skill->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Supprimer</button>
                                </form>
                            </td>
                        @endif
                    @endif
                </tr>
            @endforeach
        </body>
    </table>
@endsection
