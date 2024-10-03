@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Modifier Hébergement'])

<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-warning text-white">
            <h3 class="mb-0">Modifier l'hébergement: {{ $accommodation->name }}</h3>
        </div>
        <div class="card-body p-4">
            <!-- Gestion des erreurs de validation -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulaire de modification -->
            <form action="{{ route('hebergement.update', $accommodation->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nom -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $accommodation->name }}" required placeholder="Entrez le nom de l'hébergement">
                </div>

                <!-- Type -->
                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-control" id="type" name="type" required>
                        <option value="Hôtel" {{ $accommodation->type == 'Hôtel' ? 'selected' : '' }}>Hôtel</option>
                        <option value="Maison d’hôtes" {{ $accommodation->type == 'Maison d’hôtes' ? 'selected' : '' }}>Maison d’hôtes</option>
                        <option value="Camping" {{ $accommodation->type == 'Camping' ? 'selected' : '' }}>Camping</option>
                        <option value="Appartement" {{ $accommodation->type == 'Appartement' ? 'selected' : '' }}>Appartement</option>
                        <option value="Autre" {{ $accommodation->type == 'Autre' ? 'selected' : '' }}>Autre</option>
                    </select>
                </div>

                <!-- Région -->
                <div class="mb-3">
                    <label for="region" class="form-label">Région</label>
                    <input type="text" class="form-control" id="region" name="region" value="{{ $accommodation->region }}" required placeholder="Entrez la région de l'hébergement">
                </div>

                <!-- Adresse -->
                <div class="mb-3">
                    <label for="address" class="form-label">Adresse</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $accommodation->address }}" required placeholder="Entrez l'adresse de l'hébergement">
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Entrez une description de l'hébergement">{{ $accommodation->description }}</textarea>
                </div>

                <!-- Prix par nuit -->
                <div class="mb-3">
                    <label for="price_per_night" class="form-label">Prix par nuit (€)</label>
                    <input type="number" class="form-control" id="price_per_night" name="price_per_night" value="{{ $accommodation->price_per_night }}" required placeholder="Entrez le prix par nuit">
                </div>

                <!-- Certification (facultatif) -->
                <div class="mb-3">
                    <label for="certification" class="form-label">Certification (facultatif)</label>
                    <input type="text" class="form-control" id="certification" name="certification" value="{{ $accommodation->certification }}" placeholder="Entrez la certification écologique (ex: Ecolabel)">
                </div>

                <!-- Image (facultatif) -->
                <div class="mb-3">
                    <label for="image" class="form-label">Image (facultatif)</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    <!-- Si une image existe déjà, la montrer -->
                    @if($accommodation->image)
                        <div class="mt-2">
                            <img src="{{ asset('images/' . $accommodation->image) }}" class="img-fluid rounded" style="max-height: 200px;" alt="{{ $accommodation->name }}">
                            <p class="text-muted">Image actuelle</p>
                        </div>
                    @endif
                </div>

                <!-- Boutons -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
                    <a href="{{ route('hebergement.index') }}" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
