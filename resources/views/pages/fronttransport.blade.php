@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Réserve Transport'])
<div class="container">
    <h1>Liste des Transports</h1>

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
        @foreach($transport as $t)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <!-- Display transport image if available -->
                    @if($t->image_url)
                        <img src="{{ asset('storage/' . $t->image_url) }}" class="card-img-top" alt="{{ $t->model }}">
                    @else
                        <img src="{{ asset('default_image.jpg') }}" class="card-img-top" alt="Default Image">
                    @endif
                    <div class="card-body">
                        <!-- Display transport type and model -->
                        <h5 class="card-title">{{ $t->type }} - {{ $t->model }}</h5>
                        <p class="card-text">Prix par heure: {{ $t->prix_heure }} TND</p>
                        <p class="card-text">Batterie: {{ $t->battrie }}%</p>
                        <p class="card-text">Lieu de location: {{ $t->lieux_location }}</p>

                        <!-- Boutons Détail et Réserver -->
                        <div class="d-flex justify-content-between">
                            <!-- Button Détail -->
                            @if(isset($t->id))
                            <a href="{{ route('transport.show', ['id' => $t->id]) }}" class="btn btn-info">Détail</a>
                        @endif

                            @if(auth()->check() && auth()->user()->role === 'user')
                                <!-- Button Réserver -->
                                <form action="{{ route('reservations.store') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="transport_id" value="{{ $t->id }}">

                                    <!-- Input for number of hours to rent -->
                                    <div class="form-group">
                                        <label for="nombre_heures">Nombre d'heures:</label>
                                        <input type="number" name="nombre_heures" id="nombre_heures"
                                               min="1" value="1" required class="form-control" style="width: 100px;">
                                    </div>

                                    <button type="submit" class="btn btn-primary"
                                            onclick="return confirm('Êtes-vous sûr de vouloir réserver ce transport ?');">
                                        Réserver
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination Links -->
    {{ $transport->links() }}
</div>
@endsection
