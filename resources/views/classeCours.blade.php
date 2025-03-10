@extends('template')
@section('content')
    <h2>Liste des classes et leurs cours</h2>
    <table class="table table-bordered">
        <tr>
            <th>Classe</th>
            <th>Cours</th>
            <th>Actions</th>
        </tr>
        @foreach($classes as $classe)
            <tr>
                <td>{{ $classe->nom }}</td>
                <td>
                    @foreach($classe->cours as $cours)
                        {{ $cours->nom }}<br>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('editCoursClasse', $classe->id) }}" class="btn btn-primary">Gérer les cours</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
