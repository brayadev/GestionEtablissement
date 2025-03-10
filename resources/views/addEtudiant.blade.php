@extends('template')
@section('content')
    <div class="container">
        <h2>Ajouter un nouvel étudiant</h2>
        <form action="{{ route('enregistrerEtudiant') }}" method="POST">
            @csrf
            @method('Post')
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>

            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Adresse</label>
                <input type="text" class="form-control" id="address" name="address">
            </div>

            <div class="mb-3">
                <label for="classe_id" class="form-label">Classe</label>
                <select class="form-control" id="classe_id" name="classe_id" required>
                    <option value="">Sélectionner une classe</option>
                    @foreach($classes as $c)
                        <option value="{{ $c->id }}">{{ $c->nom }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
@endsection
