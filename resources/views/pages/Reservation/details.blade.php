@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Détails de la Réservation'])

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Détails de la Réservation #{{ $reservation->id }}</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5><i class="fas fa-hotel"></i> Hébergement</h5>
                            <p>{{ $reservation->hebergement->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5><i class="fas fa-calendar-alt"></i> Dates</h5>
                            <p>Du {{ $reservation->start_date }} au {{ $reservation->end_date }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5><i class="fas fa-users"></i> Nombre d'invités</h5>
                            <p>{{ $reservation->guests }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5><i class="fas fa-money-bill-wave"></i> Prix Total</h5>
                            <p>€{{ number_format($reservation->total_price, 2) }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5><i class="fas fa-info-circle"></i> Statut de la Réservation</h5>
                            <span class="badge badge-{{ $reservation->status == 'confirmée' ? 'success' : 'warning' }}">
                                {{ ucfirst($reservation->status) }}
                            </span>
                        </div>
                        <div class="col-md-6">
                            <h5><i class="fas fa-map-marker-alt"></i> Adresse</h5>
                            <p>{{ $reservation->hebergement->address }}</p>
                        </div>
                    </div>

                    @if($reservation->status == 'en attente')
                        <div class="alert alert-warning text-center">
                            Votre réservation est en attente de confirmation.
                        </div>
                    @elseif($reservation->status == 'confirmée')
                        <div class="alert alert-success text-center">
                            Votre réservation a été confirmée !
                        </div>
                    @endif
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Retour aux Réservations</a>
                    @if($reservation->status == 'en attente')
                        <a href="{{ route('reservations.payment', $reservation->id) }}" class="btn btn-primary ml-2">
                            <i class="fas fa-credit-card"></i> Payer Maintenant
                        </a>
                        <a href="{{ route('reservations.delete', $reservation->id) }}" class="btn btn-danger ml-2" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')">
                            <i class="fas fa-trash-alt"></i> Annuler
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<!-- FontAwesome pour les icônes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    /* Styles personnalisés pour une présentation plus professionnelle */
    .card {
        border-radius: 10px;
    }
    .card-header {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    .card-footer {
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }
    .badge-success {
        background-color: #28a745;
    }
    .badge-warning {
        background-color: #ffc107;
    }
</style>
@endpush
