@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Créer une nouvelle mission</h1>

    <!-- Formulaire de création -->
    <form action="{{ route('missions.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" class="form-control" id="titre" name="titre" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="lieu">Lieu</label>
            <input type="text" class="form-control" id="lieu" name="lieu" required>
        </div>

        <div class="form-group">
            <label for="date_debut">Date de début</label>
            <input type="date" class="form-control" id="date_debut" name="date_debut" required>
        </div>

        <div class="form-group">
            <label for="date_fin">Date de fin</label>
            <input type="date" class="form-control" id="date_fin" name="date_fin" required>
        </div>

        <div class="form-group">
            <label for="nom_association">Nom de l'association</label>
            <input type="text" class="form-control" id="nom_association" name="nom_association" required>
        </div>

        <div class="form-group">
            <label for="description_association">Description de l'association</label>
            <textarea class="form-control" id="description_association" name="description_association" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Créer</button>
    </form>
</div>
@endsection
