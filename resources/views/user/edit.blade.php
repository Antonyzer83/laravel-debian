@extends('layouts.app')

@section('title', 'Modification d\'un utilisateur')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <form method="post" class="form" action="{{ route('users.update', $user->id) }}">
                    @method('PATCH')
                    @csrf
                    <div class="form-group">
                        <label for="last_name">Nom :</label>
                        <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}"/>
                    </div>
                    <div class="form-group">
                        <label for="first_name">Prénom :</label>
                        <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}"/>
                    </div>
                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input type="text" class="form-control" name="email" value="{{ $user->email }}"/>
                    </div>
                    @if(Auth::user()->status === 1)
                        <div class="form-group">
                            <label for="status">Statut (0 : Standard | 1 : Admin) :</label>
                            <input type="number" class="form-control" name="status" value="{{ $user->status }}" min="0" max="1"/>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="bio">Bio :</label>
                        <input type="text" class="form-control" name="bio" value="{{ $user->bio }}"/>
                    </div>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </form>
            </div>

            <div class="col-sm">
                <form method="post" class="form" action="{{ url('users/'.  $user->id  . '/skills') }}">
                    @csrf
                    <div class="form-group">
                        <label class="font-weight-bold">Ajouter une compétence :</label>
                        <select class="form-control" name="skill_id">
                            @foreach($available_skills as $available_skill)
                                <option value="{{ $available_skill->id }}">{{ $available_skill->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </form>

                <form method="post" class="form my-4" action="{{ url('users/'.  $user->id  . '/skills') }}">
                    @method('DELETE')
                    @csrf
                    <div class="form-group">
                        <label class="font-weight-bold">Supprimer une compétence :</label>
                        <select class="form-control" name="skill_id">
                            @foreach($skills as $skill)
                               <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </form>

                <form method="post" class="form" action="{{ url('users/'.  $user->id  . '/skills') }}">
                    @method('PATCH')
                    @csrf
                    <label class="font-weight-bold">Modifier mes compétences :</label>
                    @foreach($skills as $skill)
                        <div class="form-group">
                            <label for="skills[level][]">{{ $skill->name }}</label>
                            <input type="number" class="form-control" name="skills[level][]" value="{{ $skill->pivot->level }}" min="1" max="5">
                            <input type="hidden" name="skills[id][]" value="{{ $skill->id }}">
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary">Valider</button>
                </form>
            </div>
        </div>
    </div>

@endsection
