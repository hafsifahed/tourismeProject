@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Détails de l\'Hébergement'])

<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">{{ $accommodation->name }}</h3>
        </div>
        <div class="card-body p-4">
            <!-- Image -->
            @if($accommodation->image)
                <div class="text-center mb-4">
                    <img src="{{ asset('images/' . $accommodation->image) }}" class="img-fluid rounded" alt="{{ $accommodation->name }}" style="max-height: 400px;">
                </div>
            @endif

            <div class="row">
                <!-- Type -->
                <div class="col-md-6 mb-3">
                    <h5><i class="fas fa-building"></i> Type</h5>
                    <p>{{ $accommodation->type }}</p>
                </div>

                <!-- Région -->
                <div class="col-md-6 mb-3">
                    <h5><i class="fas fa-map-marker-alt"></i> Région</h5>
                    <p>{{ $accommodation->region }}</p>
                </div>
            </div>

            <div class="row">
                <!-- Adresse -->
                <div class="col-md-6 mb-3">
                    <h5><i class="fas fa-map-pin"></i> Adresse</h5>
                    <p>{{ $accommodation->address }}</p>
                </div>

                <!-- Prix par nuit -->
                <div class="col-md-6 mb-3">
                    <h5><i class="fas fa-euro-sign"></i> Prix par nuit</h5>
                    <p>€{{ number_format($accommodation->price_per_night, 2) }}</p>
                </div>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <h5><i class="fas fa-info-circle"></i> Description</h5>
                <p>{{ $accommodation->description }}</p>
            </div>

            <!-- Certification (si disponible) -->
            @if($accommodation->certification)
                <div class="mb-4">
                    <h5><i class="fas fa-leaf"></i> Certification écologique</h5>
                    <p>{{ $accommodation->certification }}</p>
                </div>
            @endif

            <!-- Bouton retour -->
            <div class="text-center mt-4">
                <a href="{{ route('hebergement.index') }}" class="btn btn-secondary btn-lg">
                    <i class="fas fa-arrow-left"></i> Retour à la liste des hébergements
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
