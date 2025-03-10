@extends('template')
@section('content')

    <a class="btn btn-primary" href="{{route('creerCours')}}">Ajouter un cours</a>


    <table class="table table-bordered">
        <tr>
            <td>Nom</td>
            <td>Description</td>
            <td>Professeur</td>
        </tr>
        @foreach($cours as $e)
            <tr>
                <td>{{$e->nom}}</td>
                <td>{{$e->description}}</td>
                <td>
                    @if(isset($professeurs[$e->Professeur_id]))
                        {{ 'M. '.$professeurs[$e->Professeur_id]->nom.' '.$professeurs[$e->Professeur_id]->prenom }}
                    @else
                        Professeur non trouvé
                    @endif
                </td>
                <td>
                    <a class="btn btn-primary">Modifier</a>
                    <form action="{{route('supprimerCours',['id'=>$e->id])}}" method="post">
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
