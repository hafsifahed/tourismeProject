@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Ajouter Hébergement'])

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-gradient-primary text-white">
                    <h4 class="mb-0">Ajouter un Hébergement Écoresponsable</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('hebergement.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Nom -->
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-home"></i></span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required placeholder="Entrez le nom de l'hébergement" value="{{ old('name') }}">
                            </div>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Type -->
                        <div class="form-group mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" required>
                                <option value="" disabled selected>Choisissez un type d'hébergement</option>
                                <option value="Hôtel" {{ old('type') == 'Hôtel' ? 'selected' : '' }}>Hôtel</option>
                                <option value="Maison d’hôtes" {{ old('type') == 'Maison d’hôtes' ? 'selected' : '' }}>Maison d’hôtes</option>
                                <option value="Camping" {{ old('type') == 'Camping' ? 'selected' : '' }}>Camping</option>
                                <option value="Appartement" {{ old('type') == 'Appartement' ? 'selected' : '' }}>Appartement</option>
                                <option value="Autre" {{ old('type') == 'Autre' ? 'selected' : '' }}>Autre</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Région -->
                        <div class="form-group mb-3">
                            <label for="region" class="form-label">Région</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" class="form-control @error('region') is-invalid @enderror" id="region" name="region"  placeholder="Entrez la région de l'hébergement" value="{{ old('region') }}">
                            </div>
                            @error('region')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Adresse -->
                        <div class="form-group mb-3">
                            <label for="address" class="form-label">Adresse</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-map-pin"></i></span>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" required placeholder="Entrez l'adresse de l'hébergement" value="{{ old('address') }}">
                            </div>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Description</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Entrez une description de l'hébergement">{{ old('description') }}</textarea>
                            </div>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Prix par nuit -->
                        <div class="form-group mb-3">
                            <label for="price_per_night" class="form-label">Prix par nuit (€)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-euro-sign"></i></span>
                                <input type="number" class="form-control @error('price_per_night') is-invalid @enderror" id="price_per_night" name="price_per_night" required placeholder="Entrez le prix par nuit" value="{{ old('price_per_night') }}">
                            </div>
                            @error('price_per_night')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Certification -->
                        <div class="form-group mb-3">
                            <label for="certification" class="form-label">Certification (facultatif)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-certificate"></i></span>
                                <input type="text" class="form-control @error('certification') is-invalid @enderror" id="certification" name="certification" placeholder="Entrez la certification écologique (ex: Ecolabel)" value="{{ old('certification') }}">
                            </div>
                            @error('certification')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image -->
                        <div class="form-group mb-3">
                            <label for="image" class="form-label">Image (facultatif)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-image"></i></span>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                            </div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group d-flex justify-content-end">
                            <button type="submit" class="btn btn-success me-2">Créer l'Hébergement</button>
                            <a href="{{ route('hebergement.index') }}" class="btn btn-secondary">Retour à la liste</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
