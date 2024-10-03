@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'liste des missionss'])
<div class="container mt-4">
    <h1 class="mb-4">Opportunités de volontariat écoresponsable</h1>

    <div class="row">
        @foreach($missions as $mission)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $mission->titre }}</h5>
                    <p class="card-text">{{ Str::limit($mission->description, 100) }}</p>
                    <p><strong>Lieu :</strong> {{ $mission->lieu }}</p>
                    <p><strong>Date de début :</strong> {{ \Carbon\Carbon::parse($mission->date_debut)->format('d/m/Y') }}</p>
                    <p><strong>Date de fin :</strong> {{ \Carbon\Carbon::parse($mission->date_fin)->format('d/m/Y') }}</p>
                    <p><strong>Association :</strong> {{ $mission->nom_association }}</p>
                    <p class="card-text"><small>{{ Str::limit($mission->description_association, 100) }}</small></p>

                    <!-- Bouton Postuler (statique) -->
                    <a href="#" class="btn btn-success">Postuler</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
