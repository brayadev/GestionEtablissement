@extends('template')
@section('content')

    <a class="btn btn-primary" href="{{route('creerProf')}}">Ajouter un professeur</a>
    <table class="table table-bordered">
        <tr>
            <td>Nom</td>
            <td>Prenom</td>
            <td>Email</td>
            <td>Telephone</td>
            <td>Matiere</td>

        </tr>
        @foreach($professeurs as $e)
            <tr>
                <td>{{$e->nom}}</td>
                <td>{{$e->prenom}}</td>
                <td>{{$e->email}}</td>
                <td>{{$e->telephone}}</td>
                <td>{{$e->matiere}}</td>
                <td>
                    <a class="btn btn-primary">Modifier</a>
                    <form action="{{route('supprimerProf',['id'=>$e->id])}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
        @if(sizeof($professeurs) == 0)
            <p>La vide est vide </p>
        @endif
    </table>
@endsection
