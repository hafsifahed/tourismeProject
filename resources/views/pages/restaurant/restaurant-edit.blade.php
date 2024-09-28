@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Editer Restaurant'])

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

                    <form action="{{ route('restaurant.update', $restaurant->id_restaurant) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Use PUT method for updating -->

                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $restaurant->nom) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" value="{{ old('adresse', $restaurant->adresse) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="ville" class="form-label">Ville</label>
                            <input type="text" class="form-control" id="ville" name="ville" value="{{ old('ville', $restaurant->ville) }}">
                        </div>
                        <div class="mb-3">
                            <label for="code_postal" class="form-label">Code Postal</label>
                            <input type="text" class="form-control" id="code_postal" name="code_postal" value="{{ old('code_postal', $restaurant->code_postal) }}">
                        </div>
                        <div class="mb-3">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <input type="text" class="form-control" id="telephone" name="telephone" value="{{ old('telephone', $restaurant->telephone) }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $restaurant->email) }}">
                        </div>
                        <div class="mb-3">
                            <label for="site_web" class="form-label">Site Web</label>
                            <input type="url" class="form-control" id="site_web" name="site_web" value="{{ old('site_web', $restaurant->site_web) }}">
                        </div>
                        <div class="mb-3">
                            <label for="type_cuisine" class="form-label">Type de Cuisine</label>
                            <select class="form-select" id="type_cuisine" name="type_cuisine">
                                <option value="">Sélectionner un type de cuisine</option>
                                <option value="Italienne" {{ old('type_cuisine', $restaurant->type_cuisine) == 'Italienne' ? 'selected' : '' }}>Italienne</option>
                                <option value="Française" {{ old('type_cuisine', $restaurant->type_cuisine) == 'Française' ? 'selected' : '' }}>Française</option>
                                <option value="Mexicaine" {{ old('type_cuisine', $restaurant->type_cuisine) == 'Mexicaine' ? 'selected' : '' }}>Mexicaine</option>
                                <option value="Japonaise" {{ old('type_cuisine', $restaurant->type_cuisine) == 'Japonaise' ? 'selected' : '' }}>Japonaise</option>
                                <option value="Chinoise" {{ old('type_cuisine', $restaurant->type_cuisine) == 'Chinoise' ? 'selected' : '' }}>Chinoise</option>
                                <option value="Indienne" {{ old('type_cuisine', $restaurant->type_cuisine) == 'Indienne' ? 'selected' : '' }}>Indienne</option>
                                <option value="Méditerranéenne" {{ old('type_cuisine', $restaurant->type_cuisine) == 'Méditerranéenne' ? 'selected' : '' }}>Méditerranéenne</option>
                            </select>
                        </div>

                        <!-- Checkboxes for the boolean fields with existing values -->
                        <div class="form-check mb-3">
                            <input type="hidden" name="certification_bio" value="0"> <!-- Hidden input for unchecked state -->
                            <input type="checkbox" class="form-check-input" id="certification_bio" name="certification_bio" value="1" {{ old('certification_bio', $restaurant->certification_bio) ? 'checked' : '' }}>
                            <label class="form-check-label" for="certification_bio">Certification Bio</label>
                        </div>
                        <div class="form-check mb-3">
                            <input type="hidden" name="produits_locaux" value="0"> <!-- Hidden input for unchecked state -->
                            <input type="checkbox" class="form-check-input" id="produits_locaux" name="produits_locaux" value="1" {{ old('produits_locaux', $restaurant->produits_locaux) ? 'checked' : '' }}>
                            <label class="form-check-label" for="produits_locaux">Produits Locaux</label>
                        </div>
                        <div class="form-check mb-3">
                            <input type="hidden" name="saisonnalite" value="0"> <!-- Hidden input for unchecked state -->
                            <input type="checkbox" class="form-check-input" id="saisonnalite" name="saisonnalite" value="1" {{ old('saisonnalite', $restaurant->saisonnalite) ? 'checked' : '' }}>
                            <label class="form-check-label" for="saisonnalite">Saisonnalité</label>
                        </div>
                        <div class="form-check mb-3">
                            <input type="hidden" name="gestion_dechets" value="0"> <!-- Hidden input for unchecked state -->
                            <input type="checkbox" class="form-check-input" id="gestion_dechets" name="gestion_dechets" value="1" {{ old('gestion_dechets', $restaurant->gestion_dechets) ? 'checked' : '' }}>
                            <label class="form-check-label" for="gestion_dechets">Gestion des Déchets</label>
                        </div>
                        <div class="form-check mb-3">
                            <input type="hidden" name="economie_eau" value="0"> <!-- Hidden input for unchecked state -->
                            <input type="checkbox" class="form-check-input" id="economie_eau" name="economie_eau" value="1" {{ old('economie_eau', $restaurant->economie_eau) ? 'checked' : '' }}>
                            <label class="form-check-label" for="economie_eau">Économie d'Eau</label>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description">{{ old('description', $restaurant->description) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image_url" class="form-label">Image URL</label>
                            <input type="url" class="form-control" id="image_url" name="image_url" value="{{ old('image_url', $restaurant->image_url) }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
