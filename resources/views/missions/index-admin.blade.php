@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Gestion des missions de volontariat</h1>

    <!-- Bouton pour créer une nouvelle mission -->
    <a href="{{ route('missions.create') }}" class="btn btn-primary mb-3">Créer une nouvelle mission</a>

    <!-- Table pour afficher la liste des missions -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-light">
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Lieu</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Nom de l'association</th>
                    <th>Description de l'association</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($missions as $mission)
                <tr>
                    <td>{{ $mission->titre }}</td>
                    <td>{{ $mission->description }}</td>
                    <td>{{ $mission->lieu }}</td>
                    <td>{{ \Carbon\Carbon::parse($mission->date_debut)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($mission->date_fin)->format('d/m/Y') }}</td>
                    <td>{{ $mission->nom_association }}</td>
                    <td>{{ $mission->description_association }}</td>
                    <td>
                        <!-- Bouton Modifier -->
                        <a href="{{ route('missions.edit', $mission->id) }}" class="btn btn-warning btn-sm">Modifier</a>

                        <!-- Formulaire pour supprimer une mission -->
                        <form action="{{ route('missions.destroy', $mission->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette mission ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
