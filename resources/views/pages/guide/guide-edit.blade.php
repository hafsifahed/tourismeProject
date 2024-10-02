@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Éditer Guide Local'])

    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('guidelocal.update', $guide->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Utiliser la méthode PUT pour la mise à jour -->

                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $guide->nom) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" value="{{ old('adresse', $guide->adresse) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="ville" class="form-label">Ville</label>
                            <input type="text" class="form-control" id="ville" name="ville" value="{{ old('ville', $guide->ville) }}">
                        </div>
                        <div class="mb-3">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <input type="text" class="form-control" id="telephone" name="telephone" value="{{ old('telephone', $guide->telephone) }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $guide->email) }}">
                        </div>
                        <div class="mb-3">
                            <label for="site_web" class="form-label">Site Web</label>
                            <input type="url" class="form-control" id="site_web" name="site_web" value="{{ old('site_web', $guide->site_web) }}">
                        </div>
                        <div class="mb-3">
                            <label for="type_service" class="form-label">Type de Service</label>
                            <select class="form-select" id="type_service" name="type_service" required>
                                <option value="">Sélectionner un type de service</option>
                                <option value="Touristique" {{ old('type_service', $guide->type_service) == 'Touristique' ? 'selected' : '' }}>Touristique</option>
                                <option value="Culturel" {{ old('type_service', $guide->type_service) == 'Culturel' ? 'selected' : '' }}>Culturel</option>
                                <option value="Aventure" {{ old('type_service', $guide->type_service) == 'Aventure' ? 'selected' : '' }}>Aventure</option>
                                <!-- Ajoutez d'autres types de service si nécessaire -->
                            </select>
                        </div>

                        <!-- Checkboxes pour les champs booléens -->
                        <div class="form-check mb-3">
                            <input type="hidden" name="disponible" value="0"> <!-- Input caché pour l'état non coché -->
                            <input type="checkbox" class="form-check-input" id="disponible" name="disponible" value="1" {{ old('disponible', $guide->disponible) ? 'checked' : '' }}>
                            <label class="form-check-label" for="disponible">Disponible</label>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description">{{ old('description', $guide->description) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image_url" class="form-label">Image URL</label>
                            <input type="url" class="form-control" id="image_url" name="image_url" value="{{ old('image_url', $guide->image_url) }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
