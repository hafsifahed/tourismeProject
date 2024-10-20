@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Réserve Transport'])

<div class="container">
    <h1>Liste des Transports</h1>

    <!-- Formulaire de filtre -->
    <div class="card mb-4 shadow">
        <div class="card-header text-white">
            <h5 class="mb-0">Rechercher un Transport</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('transport.search') }}">

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-car"></i></span>
                            <select name="model" class="form-control">
                                <option value="">Sélectionnez un modèle</option>
                                @foreach($models as $model)
                                    <option value="{{ $model }}">{{ $model }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-tags"></i></span>
                            <select name="type" class="form-control">
                                <option value="">Sélectionnez un type</option>
                                <option value="Voiture">Voiture</option>
                                <option value="Scooter">Scooter</option>
                                <option value="Vélo">Vélo</option>
                                <option value="Trottinette">Trottinette</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                            <select name="lieux_location" class="form-control">
                                <option value="">Sélectionnez un lieu</option>
                                @foreach($lieux as $lieu)
                                    <option value="{{ $lieu }}">{{ $lieu }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- Prix min et max -->
                    <div class="col-md-3 mb-3">
                        <button type="submit" class="btn btn-primary w-100">Rechercher</button>
                    </div>
                </div>
            </form>
            
            
        </div>
    </div>

    <div class="row">
        @foreach($transport as $t)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if($t->image_url)
                        <img src="{{ asset('storage/' . $t->image_url) }}" class="card-img-top" alt="{{ $t->model }}">
                    @else
                        <img src="{{ asset('default_image.jpg') }}" class="card-img-top" alt="Default Image">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $t->type }} - {{ $t->model }}</h5>
                        <p class="card-text">Prix par heure: {{ $t->prix_heure }} TND</p>
                        <p class="card-text">Batterie: {{ $t->battrie }}%</p>
                        <p class="card-text">Lieu de location: {{ $t->lieux_location }}</p>

                        <a href="{{ route('transport.show', $t->id_transport) }}" class="btn btn-primary">Voir Détails</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination Links -->
    {{ $transport->links() }}
</div>
@endsection
