@extends('template')
@section('content')
    <h2>Enregistrer un nouveau professeur</h2>

    <form action="{{route('enregistrerProf')}}" method="POST">
        @csrf
        @method('Post')
        <div class="mb-3">
            <label for="nom" class="form-label">Nom :</label>
            <input type="text" name="nom"  class="form-control" required>

            <label for="prenom" class="form-label">Prenom :</label>
            <input type="text" name="prenom"  class="form-control" required>

            <label for="email" class="form-label">Email :</label>
            <input type="text" name="email"  class="form-control">

            <label for="telephone" class="form-label">Telephone :</label>
            <input type="number" name="telephone"  class="form-control">

            <label for="matiere" class="form-label">Matiere :</label>
            <input type="text" name="matiere"  class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@endsection
