@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Ajouter Avis de Tour'])

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Ajouter un Avis</h4>
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

                        <!-- Form for Adding Tour Review -->
                        <form action="{{ route('avistour.store') }}" method="POST">
                            @csrf

                            <div class="row mb-3">
                                <!-- Guide Local -->
                                <div class="col-md-6">
                                    <label for="guide_local" class="form-label">Guide Local <span class="text-danger">*</span></label>
                                    <select class="form-select @error('guide_local') is-invalid @enderror" id="guide_local" name="guide_local" required>
                                        <option value="" disabled selected>Sélectionner un guide</option>
                                        @foreach ($guides as $guide)
                                            <option value="{{ $guide->id }}" {{ old('guide_local') == $guide->id ? 'selected' : '' }}>{{ $guide->nom }}</option>
                                        @endforeach
                                    </select>
                                    @error('guide_local')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Utilisateur -->
                                <div class="col-md-6">
                                    <label for="utilisateur" class="form-label">Utilisateur <span class="text-danger">*</span></label>
                                    <select class="form-select @error('utilisateur') is-invalid @enderror" id="utilisateur" name="utilisateur" required>
                                        <option value="" disabled selected>Sélectionner un utilisateur</option>
                                        @foreach ($utilisateurs as $utilisateur)
                                            <option value="{{ $utilisateur->id }}" {{ old('utilisateur') == $utilisateur->id ? 'selected' : '' }}>{{ $utilisateur->username }}</option>
                                        @endforeach
                                    </select>
                                    @error('utilisateur')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Note -->
                            <div class="mb-3">
                                <label for="note" class="form-label">Note <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('note') is-invalid @enderror" id="note" name="note" min="1" max="5" value="{{ old('note') }}" required placeholder="Note de 1 à 5">
                                @error('note')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Commentaire -->
                            <div class="mb-3">
                                <label for="commentaire" class="form-label">Commentaire <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('commentaire') is-invalid @enderror" id="commentaire" name="commentaire" rows="4" required placeholder="Entrez votre commentaire">{{ old('commentaire') }}</textarea>
                                @error('commentaire')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-lg btn-primary px-5">Ajouter Avis</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
