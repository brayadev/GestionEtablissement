@extends('template')
@section('content')
    <h2>Créer une Nouvelle Classe</h2>

    <form action="{{route('enregistrerClasse')}}" method="POST">
        @csrf
        @method('Post')
        <div class="mb-3">
            <label for="name" class="form-label">Nom de la Classe :</label>
            <input type="text" name="nom"  class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="level" class="form-label">Niveau :</label>
            <input type="text" name="niveau"  class="form-control">
        </div>

        <div class="mb-3">
            <label for="capacity" class="form-label">Capacité :</label>
            <input type="number" name="capacite"  class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
@endsection
