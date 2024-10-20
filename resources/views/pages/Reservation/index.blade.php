@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Hébergements Écoresponsables'])

<div class="container mt-5">
    <h2 class="mb-4">Historique des Réservations</h2>

    @if($reservations->isEmpty())
        <div class="alert alert-warning" role="alert">
            Aucune réservation trouvée.
        </div>
    @else
        <div class="card">
            <div class="card-header">
                <h5>Vos Réservations</h5>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered mt-4">
                    <thead class="thead-light">
                        <tr>
                            <th>Hébergement</th>
                            <th>Date de début</th>
                            <th>Date de fin</th>
                            <th>Nombre d'invités</th>
                            <th>Statut</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->hebergement->name }}</td>
                                <td>{{ $reservation->start_date }}</td>
                                <td>{{ $reservation->end_date }}</td>
                                <td>{{ $reservation->guests }}</td>
                                <td>{{ ucfirst($reservation->status) }}</td>
                                <td>€{{ number_format($reservation->total_price, 2) }}</td>
                                <td>
                                    @if($reservation->status == 'en attente')
                                        <a href="{{ route('reservations.payment', $reservation->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-credit-card"></i> Payer
                                        </a>
                                       
                                    @endif
                                    <a href="{{ route('reservations.details', $reservation->id) }}" class="btn btn-secondary btn-sm ml-2">
                                        <i class="fas fa-info-circle"></i> Détails
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    @endif
</div>
@endsection

@push('styles')
<!-- Ajout de FontAwesome pour les icônes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    /* Styles personnalisés pour améliorer la table */
    .table th, .table td {
        vertical-align: middle;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
</style>
@endpush
