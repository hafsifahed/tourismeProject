@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Liste des Réservations'])
    
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <a href="{{ route('reservations.create') }}" class="btn btn-primary">Ajouter une Réservation</a>
                </div>

                @if(session('success'))
                    <div id="success-alert" class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div id="error-alert" class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <script>
                    setTimeout(function() {
                        var successAlert = document.getElementById('success-alert');
                        var errorAlert = document.getElementById('error-alert');
                        if (successAlert) {
                            successAlert.style.display = 'none';
                        }
                        if (errorAlert) {
                            errorAlert.style.display = 'none';
                        }
                    }, 3000);
                </script>

                <!-- Search Form -->
                <div class="card-body px-0 pt-0 pb-2">
                    <form action="{{ route('reservations.list') }}" method="GET" class="mb-3">
                        <input type="text" name="search" value="{{ request()->input('search') }}" placeholder="Rechercher par activité ou utilisateur..." class="form-control" />
                        <button type="submit" class="btn btn-primary mt-2">Chercher</button>
                    </form>

                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Activité</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Utilisateur</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre de Places</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $reservation)
                                    <tr>
                                        <td>{{ optional($reservation->activite)->nom }}</td> <!-- Safely access activity name -->
                                        <td>{{ optional($reservation->utilisateur)->email }}</td> <!-- Assuming you have a name field in User -->
                                        <td>{{ $reservation->nombre_places }}</td>
                                        <td class="align-middle text-end">
                                            <a href="{{ route('reservations.show', $reservation->id) }}" class="btn btn-info">Voir</a>
                                            <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-warning">Modifier</a>

                                            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination Links -->
                        {{ $reservations->links() }}
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 
@endsection