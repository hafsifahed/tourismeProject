@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Détails du Guide Local'])

    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body text-center">

                    <!-- Display the photo at the top -->
                    @if($guide->photo_url)
                        <img src="{{ $guide->photo_url }}" alt="Photo de {{ $guide->nom }}" class="img-fluid mb-3" style="max-height: 300px; object-fit: cover;">
                    @endif

                    <h2 class="mt-2">{{ $guide->nom }}</h2>
                    <p><strong>Description:</strong> {{ $guide->description }}</p>
                    <p><strong>Région:</strong> {{ $guide->region }}</p>
                    <p><strong>Ville:</strong> {{ $guide->ville }}</p>
                    <p><strong>Type de Tours:</strong> {{ $guide->type_tour }}</p>
                    <p><strong>Disponibilités:</strong> {{ $guide->disponibilites }}</p>
                    <p><strong>Téléphone:</strong> {{ $guide->telephone }}</p>
                    <p><strong>Email:</strong> {{ $guide->email }}</p>
                    <p><strong>Site Web:</strong> <a href="{{ $guide->site_web }}" target="_blank">{{ $guide->site_web }}</a></p>
                    <p><strong>Certification:</strong> {{ $guide->certification ? 'Oui' : 'Non' }}</p>
                    <p><strong>Tour de Groupe:</strong> {{ $guide->tour_groupe ? 'Oui' : 'Non' }}</p>
                    <p><strong>Tour Privé:</strong> {{ $guide->tour_prive ? 'Oui' : 'Non' }}</p>
                    <p><strong>Commentaires:</strong> {{ $guide->commentaires }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
