@extends('layouts.app')

@section('title', 'Modification d\'un utilisateur')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <form method="post" class="form" action="{{ route('skills.update', $skill->id) }}">
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
                    <button type="submit" class="btn btn-primary">Valider</button>
                </form>
            </div>

            <div class="col-sm">
                <form method="post" class="form" action="{{ url('skills/' . $skill->id . '/logo') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="logo">Logo :</label>
                        <input type="file" class="form-control" name="logo" value="{{ $skill->logo }}"/>
                    </div>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </form>
            </div>
        </div>
    </div>

@endsection
