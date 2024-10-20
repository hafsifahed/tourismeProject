@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Détails de la Réservation'])

    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">

                    <h2>Détails de la Réservation</h2>

                    <p><strong>Activité:</strong> {{ $reservation->activite->nom }}</p> 
                    <p><strong>Utilisateur:</strong> {{ optional($reservation->utilisateur)->name }}</p> 
                    <p><strong>Nombre de Places:</strong> {{ $reservation->nombre_places }}</p> 

                    <!-- Action buttons -->
                    <a href="{{ route('reservations.edit', $reservation->id) }}" class='btn btn-warning'>Modifier</a>

                    <!-- Form for deletion -->
                    <form action="{{ route('reservations.destroy', $reservation->id) }}" method='POST' style='display:inline;'>
                        @csrf 
                        @method('DELETE') 
                        <button type='submit' class='btn btn-danger'>Supprimer</button> 
                    </form>

                    <!-- Back link -->
                    <a href="{{ route('reservations.list') }}" class='btn btn-secondary mt-3'>Retour à la liste</a>

                </div>
            </div>
        </div>
    </div>
@endsection