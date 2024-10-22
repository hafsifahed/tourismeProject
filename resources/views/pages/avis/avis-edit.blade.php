@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Ajouter Réservation de Tour'])

    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('avistour.update', $avis->id) }}" method="POST">
                        @csrf
                        @method("PUT")

                        <div class="mb-3">
                            <label for="guide_local" class="form-label">Guide Local</label>
                            <select class="form-select" id="guide_local" name="guide_local" required>
                                <option value="" disabled>Selectionner un Guide</option>
                                @if($guides->isEmpty())
                                    <option value="" disabled>Aucun Guide disponible</option>
                                @else
                                    @foreach ($guides as $guide)
                                        <option value="{{ $guide->id }}"
                                            {{ (old('guide_local', $avis->guide_local) == $guide->id) ? 'selected' : '' }}>
                                            {{ $guide->nom }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @if(empty($avis->guide_local))
                                <small class="text-muted">Aucun guide spécifié.</small>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="utilisateur" class="form-label">Utilisateur</label>
                            <select class="form-select" id="utilisateur" name="utilisateur" required>
                                <option value="" disabled>Selectionner un Utilisateur</option>
                                @if($utilisateur->isEmpty())
                                    <option value="" disabled>Aucun Utilisateurs disponible</option>
                                @else
                                    @foreach ($utilisateur as $user)
                                        <option value="{{ $user->id }}"
                                            {{ (old('utilisateur', $avis->utilisateur) == $user->id) ? 'selected' : '' }}>
                                            {{ $user->username }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @if(empty($avis->utilisateur))
                                <small class="text-muted">Aucun utilisateur spécifié.</small>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="note" class="form-label">Note</label>
                            <input type="number" class="form-control" id="note" name="note"
                                   min="1" max="5" required value="{{ old('note', $avis->note) }}">
                        </div>

                        <div class="mb-3">
                            <label for="commentaire" class="form-label">Commentaire</label>
                            <textarea class="form-control" id="commentaire" name="commentaire" required>{{ old('commentaire', $avis->commentaire) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Mise à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
