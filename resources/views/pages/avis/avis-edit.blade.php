@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Modifier Avis de Tour'])

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Modifier un Avis</h4>
                    </div>
                    <div class="card-body p-4">

                        <!-- Error Handling -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Form for Updating Tour Review -->
                        <form action="{{ route('avistour.update', $avis->id) }}" method="POST">
                            @csrf
                            @method("PUT")

                            <!-- Guide Local -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="guide_local" class="form-label">Guide Local <span class="text-danger">*</span></label>
                                    <select class="form-select @error('guide_local') is-invalid @enderror" id="guide_local" name="guide_local" required>
                                        <option value="" disabled>Selectionner un Guide</option>
                                        @if($guides->isEmpty())
                                            <option value="" disabled>Aucun Guide disponible</option>
                                        @else
                                            @foreach ($guides as $guide)
                                                <option value="{{ $guide->id }}" {{ (old('guide_local', $avis->guide_local) == $guide->id) ? 'selected' : '' }}>{{ $guide->nom }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('guide_local')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Utilisateur -->
                                <div class="col-md-6">
                                    <label for="utilisateur" class="form-label">Utilisateur <span class="text-danger">*</span></label>
                                    <select class="form-select @error('utilisateur') is-invalid @enderror" id="utilisateur" name="utilisateur" required>
                                        <option value="" disabled>Selectionner un Utilisateur</option>
                                        @if($utilisateurs->isEmpty())
                                            <option value="" disabled>Aucun Utilisateur disponible</option>
                                        @else
                                            @foreach ($utilisateurs as $user)
                                                <option value="{{ $user->id }}" {{ (old('utilisateur', $avis->utilisateur) == $user->id) ? 'selected' : '' }}>{{ $user->username }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('utilisateur')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Note -->
                            <div class="mb-3">
                                <label for="note" class="form-label">Note <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('note') is-invalid @enderror" id="note" name="note" min="1" max="5" value="{{ old('note', $avis->note) }}" required placeholder="Donner une note de 1 à 5">
                                @error('note')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Commentaire -->
                            <div class="mb-3">
                                <label for="commentaire" class="form-label">Commentaire <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('commentaire') is-invalid @enderror" id="commentaire" name="commentaire" rows="4" required placeholder="Votre commentaire">{{ old('commentaire', $avis->commentaire) }}</textarea>
                                @error('commentaire')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-lg btn-success px-5">Mettre à jour l'Avis</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
