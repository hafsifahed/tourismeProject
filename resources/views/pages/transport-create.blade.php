@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Ajouter Transport'])
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-gradient-primary text-white">
                        <h4 class="mb-0">Ajouter un Transport Écoresponsable</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('transport.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Type -->
                            <div class="form-group mb-3">
                                <label for="type" class="form-label">Type</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-bicycle"></i></span>
                                    <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" name="type" value="{{ old('type') }}" required placeholder="Entrez le type de transport">
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Model -->
                            <div class="form-group mb-3">
                                <label for="model" class="form-label">Modèle</label>
                                <select class="form-control @error('model') is-invalid @enderror" id="model" name="model" required>
                                    <option value="" disabled selected>Sélectionner un Modèle</option>
                                    <option value="Velo" {{ old('model') == 'Velo' ? 'selected' : '' }}>Vélo</option>
                                    <option value="Moto" {{ old('model') == 'Moto' ? 'selected' : '' }}>Moto</option>
                                    <option value="Trotinette" {{ old('model') == 'Trotinette' ? 'selected' : '' }}>Trottinette</option>
                                </select>
                                @error('model')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="form-group mb-3">
                                <label for="status" class="form-label">Statut</label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option value="" disabled selected>Sélectionner un statut</option>
                                    <option value="Available" {{ old('status') == 'Available' ? 'selected' : '' }}>Disponible</option>
                                    <option value="Not Available" {{ old('status') == 'Not Available' ? 'selected' : '' }}>Non Disponible</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Prix/Heure -->
                            <div class="form-group mb-3">
                                <label for="prix_heure" class="form-label">Prix/Heure (€)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-euro-sign"></i></span>
                                    <input type="number" class="form-control @error('prix_heure') is-invalid @enderror" id="prix_heure" name="prix_heure" step="0.01" min="0" value="{{ old('prix_heure') }}" required placeholder="Entrez le prix par heure">
                                    @error('prix_heure')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Batterie -->
                            <div class="form-group mb-3">
                                <label for="battrie" class="form-label">Batterie (%)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-battery-full"></i></span>
                                    <input type="number" class="form-control @error('battrie') is-invalid @enderror" id="battrie" name="battrie" min="0" max="100" value="{{ old('battrie') }}" required placeholder="Entrez le pourcentage de batterie">
                                    @error('battrie')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Lieux de Location -->
                            <div class="form-group mb-3">
                                <label for="lieux_location" class="form-label">Lieux de Location</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    <input type="text" class="form-control @error('lieux_location') is-invalid @enderror" id="lieux_location" name="lieux_location" value="{{ old('lieux_location') }}" required placeholder="Entrez le lieu de location">
                                    @error('lieux_location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Image URL -->
                            <div class="form-group mb-3">
                                <label for="image" class="form-label">Image (facultatif)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-image"></i></span>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group d-flex justify-content-end">
                                <button type="submit" class="btn btn-success me-2">Ajouter le Transport</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
