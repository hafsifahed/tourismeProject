@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Ajouter Restaurant'])
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

                        <form action="{{ route('transport.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nom" class="form-label">Type</label>
                                <input type="text" class="form-control" id="type" name="type" required>
                            </div>
                            <div class="mb-3">
                                <label for="type_cuisine" class="form-label">Model</label>
                                <select class="form-select" id="model" name="model">
                                    <option value="">Sélectionner un Model</option>
                                    <option value="Velo">Velo</option>
                                    <option value="Moto">Moto</option>
                                    <option value="Trotinette">Trotinette</option>


                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="type_cuisine" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="">Sélectionner un status</option>
                                    <option value="Available">Available</option>
                                    <option value="Not Available">Not Availble</option>

                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="prix_heure" class="form-label">Prix_Heure</label>
                                <input type="number" class="form-control" id="prix_heure" name="prix_heure" step="0.01" min="0" placeholder="Enter price per hour">
                            </div>

                            <div class="mb-3">
                                <label for="telephone" class="form-label">Batterie</label>
                                <input type="text" class="form-control" id="battrie" name="battrie">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Lieux de Location </label>
                                <input type="text" class="form-control" id="lieux_location" name="lieux_location">
                            </div>




                            <!-- Checkboxes for the boolean fields -->
                            {{-- <div class="form-check mb-3">
                                <input type="hidden" name="certification_bio" value="0"> <!-- Hidden input for unchecked state -->
                                <input type="checkbox" class="form-check-input" id="certification_bio" name="certification_bio" value="1"> <!-- Checkbox for checked state -->
                                <label class="form-check-label" for="certification_bio">Certification Bio</label>
                            </div>
                            <div class="form-check mb-3">
                                <input type="hidden" name="produits_locaux" value="0"> <!-- Hidden input for unchecked state -->
                                <input type="checkbox" class="form-check-input" id="produits_locaux" name="produits_locaux" value="1"> <!-- Checkbox for checked state -->
                                <label class="form-check-label" for="produits_locaux">Produits Locaux</label>
                            </div>
                            <div class="form-check mb-3">
                                <input type="hidden" name="saisonnalite" value="0"> <!-- Hidden input for unchecked state -->
                                <input type="checkbox" class="form-check-input" id="saisonnalite" name="saisonnalite" value="1"> <!-- Checkbox for checked state -->
                                <label class="form-check-label" for="saisonnalite">Saisonnalité</label>
                            </div>
                            <div class="form-check mb-3">
                                <input type="hidden" name="gestion_dechets" value="0"> <!-- Hidden input for unchecked state -->
                                <input type="checkbox" class="form-check-input" id="gestion_dechets" name="gestion_dechets" value="1"> <!-- Checkbox for checked state -->
                                <label class="form-check-label" for="gestion_dechets">Gestion des Déchets</label>
                            </div>
                            <div class="form-check mb-3">
                                <input type="hidden" name="economie_eau" value="0"> <!-- Hidden input for unchecked state -->
                                <input type="checkbox" class="form-check-input" id="economie_eau" name="economie_eau" value="1"> <!-- Checkbox for checked state -->
                                <label class="form-check-label" for="economie_eau">Économie d'Eau</label>
                            </div> --}}



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
