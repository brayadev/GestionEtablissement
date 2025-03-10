@extends('template')
@section('content')
    <h2>Gérer les cours pour la classe : {{ $classe->nom }}</h2>

    <form action="{{ route('updateCoursClasse', $classe->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="cours">Sélectionnez les cours :</label>
            <select name="cours[]" id="cours" class="form-control" multiple>
                @foreach($cours as $coursItem)
                    <option value="{{ $coursItem->id }}"
                        {{ $classe->cours->contains($coursItem->id) ? 'selected' : '' }}>
                        {{ $coursItem->nom }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Mettre à jour</button>
    </form>
@endsection
