@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Hébergements Écoresponsables'])

<div class="container mt-5">
    <h2 class="mb-4 text-center">Hébergements Écoresponsables</h2>

    <!-- Carte pour le formulaire de recherche -->
    <div class="card mb-4 shadow">
        <div class="card-header  text-white">
            <h5 class="mb-0">Rechercher un Hébergement</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('hebergement.search') }}">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-bed"></i></span>
                            <input type="text" name="name" class="form-control" placeholder="Nom de l'hébergement">
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-tags"></i></span>
                            <select name="type" class="form-control">
                                <option value="">Sélectionnez un type</option>
                                <option value="Hôtel">Hôtel</option>
                                <option value="Maison d’hôtes">Maison d’hôtes</option>
                                <option value="Camping">Camping</option>
                                <option value="Appartement">Appartement</option>
                                <option value="Autre">Autre</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                            <input type="text" name="region" class="form-control" placeholder="Région">
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="input-group">
                            <span class="input-group-text">€</span>
                            <input type="number" name="price_min" class="form-control" placeholder="Prix min">
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="input-group">
                            <span class="input-group-text">€</span>
                            <input type="number" name="price_max" class="form-control" placeholder="Prix max">
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <button type="submit" class="btn btn-primary w-100">Rechercher</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        @forelse ($hebergements as $hebergement)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if ($hebergement->image)
                        <img src="{{ asset('images/' . $hebergement->image) }}" class="card-img-top" alt="{{ $hebergement->name }}">
                    @else
                        <img src="https://via.placeholder.com/400x300" class="card-img-top" alt="Image placeholder">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $hebergement->name }}</h5>
                        <p class="card-text">
                            <strong>Type:</strong> {{ $hebergement->type }} <br>
                            <strong>Région:</strong> {{ $hebergement->region }} <br>
                            <strong>Prix par nuit:</strong> €{{ $hebergement->price_per_night }}
                        </p>
                        <a href="{{ route('hebergement.details', $hebergement->id) }}" class="btn btn-secondary">Voir Détails</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center">Aucun hébergement disponible pour le moment.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
