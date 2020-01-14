    <nav class="navbar navbar-light bg-light">
        <a class="nav-link" href="/users/">Liste des utilisateurs</a>
        <a class="nav-link" href="/skills/">Liste des compétences</a>
        @if(Auth::check())
            @if(Auth::user()->status === 1)
                <a class="nav-link" href="/users/create">Ajout d'utilisateur</a>
                <a class="nav-link" href="/skills/create">Ajout d'une compétence</a>
            @endif
        @endif
    </nav>
