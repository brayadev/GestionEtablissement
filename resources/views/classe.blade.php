@extends('template')
@section('content')

    <a class="btn btn-primary" href="{{route('creerClasse')}}">Ajouter une classe</a>
<table class="table table-bordered">
    <tr>
        <td>Nom</td>
        <td>Niveau</td>
        <td>Capacite</td>

    </tr>
    @foreach($classes as $e)
        <tr>
            <td>{{$e->nom}}</td>
            <td>{{$e->niveau}}</td>
            <td>{{$e->capacite}}</td>
            <td>
                <a class="btn btn-primary">Modifier</a>
                <form action="{{route('supprimerClasse',['id'=>$e->id])}}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger" type="submit">Supprimer</button>
                </form>
            </td>
        </tr>
    @endforeach
    @if(sizeof($classes) == 0)
        <p>La vide est vide </p>
    @endif
</table>
@endsection
