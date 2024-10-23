@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Liste des Candidatures'])

<div class="container mt-4">
    <br><br><br><br><br><br><br><br><br>
    <h1 class="mb-4 text-center">Gestion des Candidatures de Volontariat</h1>

    <!-- Formulaire de filtrage -->
    <form method="GET" action="{{ route('candidatures.indexAdmin') }}" class="mb-3">
        <div class="form-row align-items-center">
            <div class="col-auto">
                <label for="mission" class="sr-only">Sélectionnez une Mission</label>
                <select name="mission" id="mission" class="form-control mb-2">
                    <option value="">-- Sélectionnez une Mission --</option>
                    @foreach($missions as $mission)
                        <option value="{{ $mission->id }}" {{ request('mission') == $mission->id ? 'selected' : '' }}>
                            {{ $mission->nom_association }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-2">Filtrer</button>
            </div>
        </div>
    </form>

    <!-- Table pour afficher la liste des candidatures -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-light">
                <tr class="text-center">
                    <th style="width: 20%;">Nom du Candidat</th>
                    <th style="width: 20%;">Email</th>
                    <th style="width: 20%;">Nom de l'Association</th> <!-- Colonne pour le nom de l'association -->
                    <th style="width: 20%;">Description de l'Association</th> <!-- Colonne pour la description de l'association -->
                    <th style="width: 15%;">CV</th> <!-- Nouvelle colonne pour le CV -->
                    <th style="width: 15%;">Date de Candidature</th>
                    <th style="width: 20%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($candidatures as $candidature)
                <tr>
                    <td class="text-center">{{ $candidature->nom }}</td>
                    <td class="text-center">{{ $candidature->email }}</td>
                    <td class="text-center">{{ $candidature->mission->nom_association }}</td> <!-- Affiche le nom de l'association -->
                    <td class="text-center">{{ $candidature->mission->description_association }}</td> <!-- Affiche la description de l'association -->
                    <td class="text-center">
                        @if($candidature->cv)
                        <a href="{{ asset('storage/' . $candidature->cv) }}" target="_blank" class="btn btn-primary btn-sm">
                            Voir CV
                        </a>
                        @else
                        <span class="text-muted">Aucun CV</span>
                        @endif
                    </td> <!-- Colonne pour le CV -->
                    <td class="text-center">{{ $candidature->created_at->format('d/m/Y') }}</td>
                    <td class="text-center">
                        <!-- Formulaire pour accepter une candidature -->
                        <form action="{{ route('candidatures.accepter', $candidature->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir accepter cette candidature ?')">Accepter</button>
                        </form>

                        <!-- Formulaire pour refuser une candidature -->
                        <form action="{{ route('candidatures.refuser', $candidature->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir refuser cette candidature ?')">Refuser</button>
                        </form>

                        <!-- Formulaire de suppression -->
                        <form action="{{ route('candidatures.destroy', $candidature->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette candidature ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
