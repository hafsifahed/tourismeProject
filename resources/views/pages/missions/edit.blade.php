@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Modifier une mission'])
<div class="container mt-4">
    <br><br><br><br><br><br><br><br><br><br>
    <h1 class="mb-4">Modifier la mission</h1>

    <!-- Formulaire de modification -->
    <form action="{{ route('missions.update', $mission->id) }}" method="POST" enctype="multipart/form-data"> <!-- Ajoutez l'attribut enctype -->
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" class="form-control" id="titre" name="titre" value="{{ $mission->titre }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required>{{ $mission->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="lieu">Lieu</label>
            <input type="text" class="form-control" id="lieu" name="lieu" value="{{ $mission->lieu }}" required>
        </div>

        <div class="form-group">
            <label for="date_debut">Date de début</label>
            <input type="date" class="form-control" id="date_debut" name="date_debut" value="{{ $mission->date_debut }}" required>
        </div>

        <div class="form-group">
            <label for="date_fin">Date de fin</label>
            <input type="date" class="form-control" id="date_fin" name="date_fin" value="{{ $mission->date_fin }}" required>
        </div>

        <div class="form-group">
            <label for="nom_association">Nom de l'association</label>
            <input type="text" class="form-control" id="nom_association" name="nom_association" value="{{ $mission->nom_association }}" required>
        </div>

        <div class="form-group">
            <label for="description_association">Description de l'association</label>
            <textarea class="form-control" id="description_association" name="description_association" rows="4" required>{{ $mission->description_association }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Image de couverture</label>
            <input type="file" class="form-control-file" id="image" name="image" accept="image/*"> <!-- Champ pour l'image -->
            <small class="form-text text-muted">Formats acceptés : JPG, JPEG, PNG (max 2 Mo).</small>
            @if($mission->image) <!-- Affichage de l'image actuelle si elle existe -->
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $mission->image) }}" alt="Image de couverture" style="max-width: 200px; max-height: 200px;">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary mt-3">Mettre à jour</button>
    </form>
</div>
@endsection
