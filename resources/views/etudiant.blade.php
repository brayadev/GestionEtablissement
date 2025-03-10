@extends('template')
@section('content')

    <a class="btn btn-primary" href="{{route('creerEtudiant')}}">Ajouter un etudiant</a>

    <div class="mt-3">
        <strong>Filtrer par classe :</strong>
        <a href="{{ route('listEtudiant') }}" class="btn btn-secondary">Toutes</a>
        @foreach($classes as $classe)
            <a href="{{ route('listEtudiant', ['classe_id' => $classe->id]) }}" class="btn btn-primary">{{ $classe->nom }}</a>
        @endforeach
    </div>
    <table class="table table-bordered">
        <tr>
            <td>Nom</td>
            <td>Prenom</td>
            <td>Email</td>
            <td>Adresse</td>
            <td>Classe</td>

        </tr>
        @foreach($etudiants as $e)
            <tr>
                <td>{{$e->nom}}</td>
                <td>{{$e->prenom}}</td>
                <td>{{$e->email}}</td>
                <td>{{$e->address}}</td>
                <td>{{$e->classe->nom}}</td>
                <td>
                    <a class="btn btn-primary">Modifier</a>
                    <form action="{{route('supprimerEtudiant',['id'=>$e->id])}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
        @if(sizeof($etudiants) == 0)
            <p>La vide est vide </p>
        @endif
    </table>
@endsection
