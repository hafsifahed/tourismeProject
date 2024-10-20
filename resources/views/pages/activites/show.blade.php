@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Détails de l\'Activité'])

    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">

                    <h2>{{ $activite->nom }}</h2>
                    <p><strong>Description:</strong> {{ $activite->description }}</p> 
                    <p><strong>Date:</strong> {{ $activite->date }}</p> 
                    <p><strong>Lieu:</strong> {{ $activite->lieu }}</p>

                    <!-- Action buttons -->
                    <div class="mt-4">
                        <a href="{{ route('activites.edit', $activite->id) }}" class='btn btn-warning'>Modifier</a>

                        <!-- Form for deletion -->
                        <form action="{{ route('activites.destroy', $activite->id) }}" method='POST' style='display:inline;'>
                            @csrf 
                            @method('DELETE') 
                            <button type='submit' class='btn btn-danger'>Supprimer</button> 
                        </form>

                        <!-- Back link -->
                        <a href="{{ route('activites.list') }}" class='btn btn-secondary mt-3'>Retour à la liste</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Review Form -->
    @if(Auth::check())
        <div class="row mt-4 mx-4">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-0 pt-0 pb-2">
                        <h3>Laisser un avis</h3>
                        <form action="{{ route('avis.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="activite_id" value="{{ $activite->id }}">
                            <input type="hidden" name="utilisateur_id" value="{{ Auth::id() }}">

                            <div class="form-group">
                                <label for="note">Note (1 à 5)</label>
                                <input type="number" name="note" id="note" min="1" max="5" required class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="commentaire">Commentaire (facultatif)</label>
                                <textarea name="commentaire" id="commentaire" rows="3" class="form-control"></textarea>
                            </div>

                            <button type="submit" class='btn btn-primary'>Soumettre</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <p class="text-danger">Vous devez être connecté pour laisser un avis.</p>
    @endif

@endsection