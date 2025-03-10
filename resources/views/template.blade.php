<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Gestion Kaay Jangu</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
<div class="container-fluid">
    <a class="navbar-brand" href="#">Kaay Jangu</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('listEtudiant')}}">Liste des Etudiants</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('listProf')}}">Liste des Professeurs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('listClasse')}}">Liste des Classes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('listCours')}}">Listes des Cours</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('listClasseCours')}}">Listes des Classes et leurs cours</a>
            </li>
        </ul>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger" type="submit">Déconnexion</button>
        </form>
    </div>
</div>
</nav>
@yield('content')
</body>
</html>
