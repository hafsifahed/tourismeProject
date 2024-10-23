@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Réserver Activité'])

<div class="container">
    <h1 class="mb-4">Liste des Activités</h1>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        @foreach($activites as $activite)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <!-- Display activity image -->
                    @if ($activite->image)
                        <img src="{{ asset('images/' . $activite->image) }}" class="card-img-top" alt="{{ $activite->nom }}">
                    @else
                        <img src="https://via.placeholder.com/400x300" class="card-img-top" alt="Image non disponible">
                    @endif

                    <div class="card-header">
                        <h5>{{ $activite->nom }}</h5>
                    </div>
                    <div class="card-body">
                        <p>{{ $activite->description }}</p>
                        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($activite->date)->format('d M Y') }}</p>
                        <p><strong>Lieu:</strong> {{ $activite->lieu }}</p>

                        @if(auth()->check() && auth()->user()->role === 'user')
                            <!-- Input for number of places -->
                            <form action="{{ route('reservations.store') }}" method="POST" style="display:inline;">
                                @csrf <!-- CSRF Token -->
                                <input type="hidden" name="activite_id" value="{{ $activite->id }}">
                                
                                <!-- Input for number of places -->
                                <div class="form-group mb-3">
                                    <label for="nombre_places">Nombre de places:</label>
                                    <input type="number" name="nombre_places" id="nombre_places" 
                                           min="1" value="1" required class="form-control" style="width: 100px; display: inline-block;">
                                </div>

                                <button type="submit" class="btn btn-primary" 
                                        onclick="return confirm('Êtes-vous sûr de vouloir réserver cette activité ?');">
                                    Réserver
                                </button>
                            </form>
                        @else
                            <!-- Message for users who are not logged in or not users -->
                            <p class="text-danger">Veuillez vous connecter pour réserver cette activité.</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination Links -->
    {{ $activites->links() }} <!-- Assuming you are paginating your activities -->
</div>

@endsection