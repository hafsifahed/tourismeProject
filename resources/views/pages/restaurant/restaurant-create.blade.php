@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Ajouter Restaurant'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">

                    

                    <form action="{{ route('restaurant.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" required>
                            @error('nom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input type="text" class="form-control @error('adresse') is-invalid @enderror" id="adresse" name="adresse" required>
                        </div>
                        <div class="mb-3">
                            <label for="ville" class="form-label">Ville</label>
                            <input type="text" class="form-control @error('ville') is-invalid @enderror" id="ville" name="ville">
                        </div>
                        <div class="mb-3">
                            <label for="code_postal" class="form-label">Code Postal</label>
                            <input type="text" class="form-control @error('code_postal') is-invalid @enderror" id="code_postal" name="code_postal">
                        </div>
                        <div class="mb-3">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <input type="text" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="site_web" class="form-label">Site Web</label>
                            <input type="url" class="form-control @error('site_web') is-invalid @enderror" id="site_web" name="site_web">
                        </div>
                        <div class="mb-3">
                            <label for="type_cuisine" class="form-label">Type de Cuisine</label>
                            <select class="form-select" id="type_cuisine" name="type_cuisine">
                                <option value="">Sélectionner un type de cuisine</option>
                                <option value="Italienne">Italienne</option>
                                <option value="Française">Française</option>
                                <option value="Mexicaine">Mexicaine</option>
                                <option value="Japonaise">Japonaise</option>
                                <option value="Chinoise">Chinoise</option>
                                <option value="Indienne">Indienne</option>
                                <option value="Méditerranéenne">Méditerranéenne</option>
                            </select>
                        </div>


                        <!-- Checkboxes for the boolean fields -->
                        <div class="form-check mb-3">
                            <input type="hidden" name="certification_bio" value="0">
                            <!-- Hidden input for unchecked state -->
                            <input type="checkbox" class="form-check-input" id="certification_bio" name="certification_bio"
                                value="1"> <!-- Checkbox for checked state -->
                            <label class="form-check-label" for="certification_bio">Certification Bio</label>
                        </div>
                        <div class="form-check mb-3">
                            <input type="hidden" name="produits_locaux" value="0">
                            <!-- Hidden input for unchecked state -->
                            <input type="checkbox" class="form-check-input" id="produits_locaux" name="produits_locaux"
                                value="1"> <!-- Checkbox for checked state -->
                            <label class="form-check-label" for="produits_locaux">Produits Locaux</label>
                        </div>
                        <div class="form-check mb-3">
                            <input type="hidden" name="saisonnalite" value="0">
                            <!-- Hidden input for unchecked state -->
                            <input type="checkbox" class="form-check-input" id="saisonnalite" name="saisonnalite"
                                value="1"> <!-- Checkbox for checked state -->
                            <label class="form-check-label" for="saisonnalite">Saisonnalité</label>
                        </div>
                        <div class="form-check mb-3">
                            <input type="hidden" name="gestion_dechets" value="0">
                            <!-- Hidden input for unchecked state -->
                            <input type="checkbox" class="form-check-input" id="gestion_dechets" name="gestion_dechets"
                                value="1"> <!-- Checkbox for checked state -->
                            <label class="form-check-label" for="gestion_dechets">Gestion des Déchets</label>
                        </div>
                        <div class="form-check mb-3">
                            <input type="hidden" name="economie_eau" value="0">
                            <!-- Hidden input for unchecked state -->
                            <input type="checkbox" class="form-check-input" id="economie_eau" name="economie_eau"
                                value="1"> <!-- Checkbox for checked state -->
                            <label class="form-check-label" for="economie_eau">Économie d'Eau</label>
                        </div>


                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image_url" class="form-label">Image URL</label>
                            <input type="url" class="form-control" id="image_url" name="image_url">
                        </div>

                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
