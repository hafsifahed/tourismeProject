@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Liste des Candidatures'])

<div class="container mt-4">
    <br><br><br><br><br><br><br><br><br><br>
    <h1 class="mb-4 text-center">Gestion des Candidatures de Volontariat</h1>

    <!-- Bouton pour créer une nouvelle candidature -->
    

    <!-- Table pour afficher la liste des candidatures -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-light">
                <tr class="text-center">
                    <th style="width: 20%;">Nom du Candidat</th>
                    <th style="width: 20%;">Email</th>
                    <th style="width: 25%;">Motivation</th>
                    <th style="width: 15%;">Date de Candidature</th>
                    <th style="width: 20%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($candidatures as $candidature)
                <tr>
                    <td class="text-center">{{ $candidature->nom }}</td>
                    <td class="text-center">{{ $candidature->email }}</td>
                    <td style="word-break: break-word;">{{ $candidature->motivation }}</td>
                    <td class="text-center">{{ $candidature->created_at->format('d/m/Y') }}</td>
                    <td class="text-center">
                        <!-- Bouton de prévisualisation du CV -->
                        @if($candidature->cv)
                        <a href="{{ asset('storage/' . $candidature->cv) }}" target="_blank" class="btn btn-primary btn-sm">
                            Voir CV
                        </a>
                        @else
                        <span class="text-muted">Aucun CV</span>
                        @endif

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
