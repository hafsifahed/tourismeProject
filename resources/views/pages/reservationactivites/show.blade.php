@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Détails de la Réservation'])

    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">

                    <h2>Détails de la Réservation</h2>

                    <p><strong>Activité:</strong> {{ $reservation->activite->nom }}</p> 
                    <p><strong>Utilisateur:</strong> {{ optional($reservation->utilisateur)->email }}</p> 
                    <p><strong>Nombre de Places:</strong> {{ $reservation->nombre_places }}</p> 

                    <!-- Action buttons -->
                   
                        <a href="{{ route('reservations.edit', $reservation->id) }}" class='btn btn-warning'>Modifier</a>
                        @if(auth()->user()->role === 'admin')
                        <!-- Form for deletion -->
                        <form action="{{ route('reservations.destroy', $reservation->id) }}" method='POST' style='display:inline;'>
                            @csrf 
                            @method('DELETE') 
                            <button type='button' class='btn btn-danger' onclick="confirmDelete(event)">Supprimer</button> 
                        </form>
                    @endif

                    <!-- Back link -->
                    <a href="{{ route('reservations.list') }}" class='btn btn-secondary mt-3'>Retour à la liste</a>

                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(event) {
            if (confirm("Êtes-vous sûr de vouloir supprimer cette réservation ? Cette action ne peut pas être annulée.")) {
                // If confirmed, submit the form
                event.target.closest("form").submit();
            }
        }
    </script>
@endsection