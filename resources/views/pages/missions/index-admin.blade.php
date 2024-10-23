@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'liste des'])
<div class="container mt-4">
    <br><br><br><br><br><br><br><br><br><br>
    <h1 class="mb-4 text-center">Gestion des missions de volontariat</h1>

    <!-- Bouton pour créer une nouvelle mission -->
    <a href="{{ route('missions.create') }}" class="btn btn-primary mb-3">Créer une nouvelle mission</a>

    <!-- Table pour afficher la liste des missions -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-light">
                <tr class="text-center">
                    <th style="width: 10%;">Titre</th>
                    <th style="width: 20%;">Description</th>
                    <th style="width: 10%;">Lieu</th>
                    <th style="width: 15%;">Période</th>
                    <th style="width: 10%;">Nom de l'association</th>
                    <th style="width: 20%;">Description de l'association</th>
                    <th style="width: 15%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($missions as $mission)
                <tr>
                    <td class="text-center">{{ $mission->titre }}</td>
                    <td style="word-break: break-word;">{{ $mission->description }}</td>
                    <td class="text-center">{{ $mission->lieu }}</td>
                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($mission->date_debut)->format('d/m/Y') }} 
                        <br> 
                        {{ \Carbon\Carbon::parse($mission->date_fin)->format('d/m/Y') }}
                    </td>
                    <td class="text-center">{{ $mission->nom_association }}</td>
                    <td style="word-break: break-word;">{{ $mission->description_association }}</td>
                    <td class="text-center">
                        <a href="{{ route('missions.edit', $mission->id) }}" class="btn btn-warning btn-sm">Modifier</a>
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
