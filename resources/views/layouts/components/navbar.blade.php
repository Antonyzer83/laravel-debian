    <nav class="navbar navbar-light bg-light">
        <a class="nav-link" href="/users/">Liste des utilisateurs</a>
        @if(Auth::check())
            @if(Auth::user()->status === 1)
                <a class="nav-link" href="/users/create">Ajout d'utilisateur</a>
            @endif
        @endif
    </nav>
