@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Détails du Restaurant'])

    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">

                    <h2>{{ $restaurant->nom }}</h2>
                    <p><strong>Adresse:</strong> {{ $restaurant->adresse }}</p>
                    <p><strong>Ville:</strong> {{ $restaurant->ville }}</p>
                    <p><strong>Code Postal:</strong> {{ $restaurant->code_postal }}</p>
                    <p><strong>Téléphone:</strong> {{ $restaurant->telephone }}</p>
                    <p><strong>Email:</strong> {{ $restaurant->email }}</p>
                    <p><strong>Site Web:</strong> <a href="{{ $restaurant->site_web }}" target="_blank">{{ $restaurant->site_web }}</a></p>
                    <p><strong>Type de Cuisine:</strong> {{ $restaurant->type_cuisine }}</p>
                    <p><strong>Certification Bio:</strong> {{ $restaurant->certification_bio ? 'Oui' : 'Non' }}</p>
                    <p><strong>Produits Locaux:</strong> {{ $restaurant->produits_locaux ? 'Oui' : 'Non' }}</p>
                    <p><strong>Saisonnalité:</strong> {{ $restaurant->saisonnalite ? 'Oui' : 'Non' }}</p>
                    <p><strong>Gestion des Déchets:</strong> {{ $restaurant->gestion_dechets ? 'Oui' : 'Non' }}</p>
                    <p><strong>Économie d'Eau:</strong> {{ $restaurant->economie_eau ? 'Oui' : 'Non' }}</p>
                    <p><strong>Description:</strong> {{ $restaurant->description }}</p>
                    <p><strong>Image:</strong></p>
                    @if($restaurant->image_url)
                        <img src="{{ $restaurant->image_url }}" alt="Image de {{ $restaurant->nom }}" class="img-fluid">
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
