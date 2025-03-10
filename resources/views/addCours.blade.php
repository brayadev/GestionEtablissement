@extends('template')
@section('content')
    <div class="container">
        <h2>Ajouter un nouveau cours</h2>
        <form action="{{ route('enregistrerCours') }}" method="POST">
            @csrf
            @method('Post')
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description" required>
            </div>


            <div class="mb-3">
                <label for="professeur_id" class="form-label">Professeur</label>
                <select class="form-control" id="professeur_id" name="professeur_id" required>
                    <option value="">Sélectionner un professeur pour le cours</option>
                    @foreach($professeurs as $c)
                        <option value="{{ $c->id }}">{{'M. '. $c->nom.' '.$c->prenom }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
@endsection
