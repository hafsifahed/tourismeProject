@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Détails du Restaurant'])

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h2 class="mb-0">{{ $restaurant->nom }}</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Adresse:</strong> {{ $restaurant->adresse }}</p>
                                <p><strong>Ville:</strong> {{ $restaurant->ville }}</p>
                                <p><strong>Code Postal:</strong> {{ $restaurant->code_postal }}</p>
                                <p><strong>Téléphone:</strong> {{ $restaurant->telephone }}</p>
                                <p><strong>Email:</strong> <a href="mailto:{{ $restaurant->email }}">{{ $restaurant->email }}</a></p>
                                <p><strong>Site Web:</strong> <a href="{{ $restaurant->site_web }}" target="_blank">{{ $restaurant->site_web }}</a></p>
                                <p><strong>Type de Cuisine:</strong> {{ $restaurant->type_cuisine }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Certification Bio:</strong> 
                                    <span class="badge {{ $restaurant->certification_bio ? 'bg-success' : 'bg-danger' }}">
                                        {{ $restaurant->certification_bio ? 'Oui' : 'Non' }}
                                    </span>
                                </p>
                                <p><strong>Produits Locaux:</strong> 
                                    <span class="badge {{ $restaurant->produits_locaux ? 'bg-success' : 'bg-danger' }}">
                                        {{ $restaurant->produits_locaux ? 'Oui' : 'Non' }}
                                    </span>
                                </p>
                                <p><strong>Saisonnalité:</strong> 
                                    <span class="badge {{ $restaurant->saisonnalite ? 'bg-success' : 'bg-danger' }}">
                                        {{ $restaurant->saisonnalite ? 'Oui' : 'Non' }}
                                    </span>
                                </p>
                                <p><strong>Gestion des Déchets:</strong> 
                                    <span class="badge {{ $restaurant->gestion_dechets ? 'bg-success' : 'bg-danger' }}">
                                        {{ $restaurant->gestion_dechets ? 'Oui' : 'Non' }}
                                    </span>
                                </p>
                                <p><strong>Économie d'Eau:</strong> 
                                    <span class="badge {{ $restaurant->economie_eau ? 'bg-success' : 'bg-danger' }}">
                                        {{ $restaurant->economie_eau ? 'Oui' : 'Non' }}
                                    </span>
                                </p>
                                <p><strong>Description:</strong> {{ $restaurant->description }}</p>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            @if($restaurant->image_url)
                                <img src="{{ $restaurant->image_url }}" alt="Image de {{ $restaurant->nom }}" class="img-fluid rounded shadow-sm" style="max-height: 400px; object-fit: cover;">
                            @else
                                <p class="text-muted">Aucune image disponible pour ce restaurant.</p>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
