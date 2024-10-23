@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Mes Candidatures'])

<div class="container mt-4">
    <br><br><br><br><br><br><br><br>
    <h1 class="mb-4 text-center">Liste de Mes Candidatures</h1>

    <!-- Vérification si aucune candidature n'existe -->
    @if($candidatures->isEmpty())
        <p class="text-center">Aucune candidature trouvée.</p>
    @else
    <!-- Table pour afficher la liste des candidatures -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-light">
                <tr class="text-center">
                    <th style="width: 10%;">Nom</th>
                    <th style="width: 10%;">Email</th>
                    <th style="width: 15%;">Nom de la Mission</th>
                    <th style="width: 25%;">Description de l'Association</th>
                    <th style="width: 20%;">Motivation</th>
                    <th style="width: 10%;">État</th>
                </tr>
            </thead>
            <tbody>
                @foreach($candidatures as $candidature)
                <tr>
                    <td class="text-center">{{ $candidature->nom }}</td>
                    <td class="text-center">{{ $candidature->email }}</td>
                    <td class="text-center">{{ $candidature->mission->nom_association }}</td>
                    <td class="text-center">{{ $candidature->mission->description_association }}</td>
                    <td style="word-break: break-word;">{{ $candidature->motivation }}</td>
                    <td class="text-center {{ $candidature->etat }}">
                        {{ ucfirst($candidature->etat) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

<!-- Ajouter du CSS personnalisé -->
<style>
    /* Styles pour la cellule "État" */
    .en-attente {
        background-color: #f0f0f0; /* Gris clair */
        color: #555; /* Texte gris foncé */
    }

    .acceptee {
        background-color: #d4edda; /* Vert clair */
        color: #155724; /* Texte vert foncé */
    }

    .refusee {
        background-color: #f8d7da; /* Rouge clair */
        color: #721c24; /* Texte rouge foncé */
    }

    /* Style de la table */
    table {
        background-color: #ffffff; /* Blanc pour le fond de la table */
    }
</style>
@endsection
