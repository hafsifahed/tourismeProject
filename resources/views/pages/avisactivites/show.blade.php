@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Détails de l\'Avis'])

    <div class="container">
        <h2>Détails de l'Avis</h2>

        <div class="card mb-4">
            <div class="card-body">
                <p><strong>Activité:</strong> {{ $avis->activite->nom }}</p>
                <p><strong>Utilisateur:</strong> {{ $avis->utilisateur->name }}</p>
                <p><strong>Note:</strong> {{ $avis->note }}</p>
                <p><strong>Commentaire:</strong> {{ $avis->commentaire }}</p>

                <!-- Boutons d'action -->
                <div class="mt-4">
                    <a href="{{ route('avis.edit', $avis->id) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('avis.destroy', $avis->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                    <a href="{{ route('avis.list') }}" class="btn btn-secondary">Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>
@endsection