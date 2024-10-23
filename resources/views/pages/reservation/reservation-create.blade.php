@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Ajouter Réservation de Tour'])

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Nouvelle Réservation</h4>
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

                        <!-- Form for Adding Tour Reservation -->
                        <form action="{{ route('reservationtour.store') }}" method="POST">
                            @csrf

                            <!-- Guide Local -->
                            <div class="mb-3">
                                <label for="guide_local" class="form-label">Guide Local <span class="text-danger">*</span></label>
                                <select class="form-select @error('guide_local') is-invalid @enderror" id="guide_local" name="guide_local" required>
                                    <option value="" disabled selected>Sélectionner un guide</option>
                                    @foreach ($guides as $guide)
                                        <option value="{{ $guide->id }}">{{ $guide->nom }}</option>
                                    @endforeach
                                </select>
                                @error('guide_local')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Utilisateur -->
                            <div class="mb-3">
                                <label for="utilisateur" class="form-label">Utilisateur <span class="text-danger">*</span></label>
                                <select class="form-select @error('utilisateur') is-invalid @enderror" id="utilisateur" name="utilisateur" required>
                                    <option value="" disabled selected>Sélectionner un utilisateur</option>
                                    @foreach ($utilisateur as $user)
                                        <option value="{{ $user->id }}">{{ $user->username }}</option>
                                    @endforeach
                                </select>
                                @error('utilisateur')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Informations -->
                            <div class="mb-3">
                                <label for="informations" class="form-label">Informations <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('informations') is-invalid @enderror" id="informations" name="informations" rows="4" required placeholder="Ajouter des détails sur la réservation">{{ old('informations') }}</textarea>
                                @error('informations')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-lg btn-primary px-5">Ajouter</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
