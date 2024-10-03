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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('hebergement.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Nom -->
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-home"></i></span>
                                <input type="text" class="form-control" id="name" name="name" required placeholder="Entrez le nom de l'hébergement">
                            </div>
                        </div>

                        <!-- Type -->
                        <div class="form-group mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-control" id="type" name="type" required>
                            <option value="" disabled selected>Choisissez un type d'hébergement</option>
                            <option value="Hôtel">Hôtel</option>
                            <option value="Maison d’hôtes">Maison d’hôtes</option>
                            <option value="Camping">Camping</option>
                            <option value="Appartement">Appartement</option>
                            <option value="Autre">Autre</option>
                        </select>
                        </div>

                        <!-- Région -->
                        <div class="form-group mb-3">
                            <label for="region" class="form-label">Région</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" class="form-control" id="region" name="region" required placeholder="Entrez la région de l'hébergement">
                            </div>
                        </div>

                        <!-- Adresse -->
                        <div class="form-group mb-3">
                            <label for="address" class="form-label">Adresse</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-map-pin"></i></span>
                                <input type="text" class="form-control" id="address" name="address" required placeholder="Entrez l'adresse de l'hébergement">
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Description</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Entrez une description de l'hébergement"></textarea>
                            </div>
                        </div>

                        <!-- Prix par nuit -->
                        <div class="form-group mb-3">
                            <label for="price_per_night" class="form-label">Prix par nuit (€)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-euro-sign"></i></span>
                                <input type="number" class="form-control" id="price_per_night" name="price_per_night" required placeholder="Entrez le prix par nuit">
                            </div>
                        </div>

                        <!-- Certification -->
                        <div class="form-group mb-3">
                            <label for="certification" class="form-label">Certification (facultatif)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-certificate"></i></span>
                                <input type="text" class="form-control" id="certification" name="certification" placeholder="Entrez la certification écologique (ex: Ecolabel)">
                            </div>
                        </div>

                        <!-- Image -->
                        <div class="form-group mb-3">
                            <label for="image" class="form-label">Image (facultatif)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-image"></i></span>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            </div>
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
