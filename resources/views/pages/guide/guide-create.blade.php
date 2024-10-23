@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Ajouter Guide Local'])
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Ajouter Guide Local</h4>
                    </div>
                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('guidelocal.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <!-- Nom -->
                                <div class="col-md-6 mb-3">
                                    <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}" placeholder="Entrez le nom du guide" required>
                                    @error('nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Région -->
                                <div class="col-md-6 mb-3">
                                    <label for="region" class="form-label">Région <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('region') is-invalid @enderror" id="region" name="region" value="{{ old('region') }}" placeholder="Entrez la région" required>
                                    @error('region')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <!-- Ville -->
                                <div class="col-md-6 mb-3">
                                    <label for="ville" class="form-label">Ville</label>
                                    <input type="text" class="form-control @error('ville') is-invalid @enderror" id="ville" name="ville" value="{{ old('ville') }}" placeholder="Entrez la ville">
                                    @error('ville')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Type de Tours -->
                                <div class="col-md-6 mb-3">
                                    <label for="type_tours" class="form-label">Type de Tours <span class="text-danger">*</span></label>
                                    <select class="form-select @error('type_tour') is-invalid @enderror" id="type_tours" name="type_tour" required>
                                        <option value="" disabled selected>Sélectionner un type</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}" {{ old('type_tour') == $type->id ? 'selected' : '' }}>{{ $type->nom_tour }}</option>
                                        @endforeach
                                    </select>
                                    @error('type_tour')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Entrez une description">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Disponibilités -->
                            <div class="mb-3">
                                <label for="disponibilites" class="form-label">Disponibilités</label>
                                <input type="text" class="form-control @error('disponibilites') is-invalid @enderror" id="disponibilites" name="disponibilites" value="{{ old('disponibilites') }}" placeholder="Entrez les disponibilités">
                                @error('disponibilites')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <!-- Téléphone -->
                                <div class="col-md-6 mb-3">
                                    <label for="telephone" class="form-label">Téléphone</label>
                                    <input type="text" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone" value="{{ old('telephone') }}" placeholder="Entrez le numéro de téléphone">
                                    @error('telephone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Entrez l'adresse email" required>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <!-- Site Web -->
                                <div class="col-md-6 mb-3">
                                    <label for="site_web" class="form-label">Site Web</label>
                                    <input type="url" class="form-control @error('site_web') is-invalid @enderror" id="site_web" name="site_web" value="{{ old('site_web') }}" placeholder="Entrez l'URL du site web">
                                    @error('site_web')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Photo -->
                                <div class="col-md-6 mb-3">
                                    <label for="photo" class="form-label">Photo <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" accept="image/*" required>
                                    @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <!-- Certification -->
                                <div class="col-md-4 mb-3 form-check">
                                    <input type="hidden" name="certification" value="0">
                                    <input type="checkbox" class="form-check-input" id="certification" name="certification" value="1" {{ old('certification') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="certification">Certification</label>
                                </div>

                                <!-- Tour de Groupe -->
                                <div class="col-md-4 mb-3 form-check">
                                    <input type="hidden" name="tour_groupe" value="0">
                                    <input type="checkbox" class="form-check-input" id="tour_groupe" name="tour_groupe" value="1" {{ old('tour_groupe') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tour_groupe">Tour de Groupe</label>
                                </div>

                                <!-- Tour Privé -->
                                <div class="col-md-4 mb-3 form-check">
                                    <input type="hidden" name="tour_prive" value="0">
                                    <input type="checkbox" class="form-check-input" id="tour_prive" name="tour_prive" value="1" {{ old('tour_prive') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tour_prive">Tour Privé</label>
                                </div>
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
