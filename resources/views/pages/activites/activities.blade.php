<!-- resources/views/activities.blade.php -->

@extends('layouts.app') <!-- Assuming you have a layout file -->

@section('content')
<div class="container">
    <h1>Liste des Activités</h1>

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
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $activite->nom }}</h5>
                    </div>
                    <div class="card-body">
                        <p>{{ $activite->description }}</p>
                        <p>Date: {{ $activite->date }}</p>
                        <p>Lieu: {{ $activite->lieu }}</p>

                        <!-- Input for number of places -->
                        <form action="{{ route('reservations.storee') }}" method="POST" style="display:inline;">
                            @csrf <!-- CSRF Token -->
                            <input type="hidden" name="activite_id" value="{{ $activite->id }}">
                            
                            <!-- Input for number of places -->
                            <div class="form-group">
                                <label for="nombre_places">Nombre de places:</label>
                                <input type="number" name="nombre_places" id="nombre_places" 
                                       min="1" value="1" required class="form-control" style="width: 100px;">
                            </div>

                            <button type="submit" class="btn btn-primary" 
                                    onclick="return confirm('Êtes-vous sûr de vouloir réserver cette activité ?');">
                                Réserver
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination Links -->
    {{ $activites->links() }} <!-- Assuming you are paginating your activities -->
</div>
@endsection