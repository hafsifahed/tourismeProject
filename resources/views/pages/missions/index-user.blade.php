@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Liste des Missions'])
<div class="container mt-4">
    <h1 class="mb-4">Opportunités de volontariat écoresponsable</h1>

    <!-- Barre de recherche -->
    <form method="GET" action="{{ route('missions.indexUser') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Rechercher par nom d'association" value="{{ request('search') }}">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Rechercher</button>
            </div>
        </div>
    </form>

    <div class="row">
        @foreach($missions as $mission)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($mission->image) <!-- Affichage de l'image si elle existe -->
                    <img src="{{ asset('storage/' . $mission->image) }}" class="card-img-top" alt="Image de couverture de {{ $mission->titre }}" style="height: 200px; object-fit: cover;">
                @else
                    <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="Image par défaut" style="height: 200px; object-fit: cover;"> <!-- Image par défaut si aucune image -->
                @endif

                <div class="card-body">
                    <h5 class="card-title">{{ $mission->titre }}</h5>
                    <p class="card-text">{{ Str::limit($mission->description, 100) }}</p>
                    <p><strong>Lieu :</strong> {{ $mission->lieu }}</p>
                    <p><strong>Date de début :</strong> {{ \Carbon\Carbon::parse($mission->date_debut)->format('d/m/Y') }}</p>
                    <p><strong>Date de fin :</strong> {{ \Carbon\Carbon::parse($mission->date_fin)->format('d/m/Y') }}</p>
                    <p><strong>Association :</strong> {{ $mission->nom_association }}</p>
                    <p class="card-text"><small>{{ Str::limit($mission->description_association, 100) }}</small></p>

                    <!-- Bouton Postuler qui redirige vers le formulaire de création d'une candidature -->
                    <a href="{{ route('candidatures.create') }}" class="btn btn-success">Postuler</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
