@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Éditer Guide Local'])

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

                    <form action="{{ route('guidelocal.update', $guide->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Utiliser la méthode PUT pour la mise à jour -->

                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $guide->nom) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description">{{ old('description', $guide->description) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="region" class="form-label">Région</label>
                            <input type="text" class="form-control" id="region" name="region" value="{{ old('region', $guide->region) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="ville" class="form-label">Ville</label>
                            <input type="text" class="form-control" id="ville" name="ville" value="{{ old('ville', $guide->ville) }}">
                        </div>
                        <div class="mb-3">
                            <label for="type_tours" class="form-label">Type de Tours</label>
                            <input type="text" class="form-control" id="type_tours" name="type_tours" value="{{ old('type_tours', $guide->type_tours) }}">
                        </div>
                        <div class="mb-3">
                            <label for="disponibilites" class="form-label">Disponibilités</label>
                            <input type="text" class="form-control" id="disponibilites" name="disponibilites" value="{{ old('disponibilites', $guide->disponibilites) }}">
                        </div>

                        <div class="form-check mb-3">
                            <input type="hidden" name="certification" value="0">
                            <input type="checkbox" class="form-check-input" id="certification" name="certification" value="1" {{ old('certification', $guide->certification) ? 'checked' : '' }}>
                            <label class="form-check-label" for="certification">Certification</label>
                        </div>
                        <div class="form-check mb-3">
                            <input type="hidden" name="tour_groupe" value="0">
                            <input type="checkbox" class="form-check-input" id="tour_groupe" name="tour_groupe" value="1" {{ old('tour_groupe', $guide->tour_groupe) ? 'checked' : '' }}>
                            <label class="form-check-label" for="tour_groupe">Tour de Groupe</label>
                        </div>
                        <div class="form-check mb-3">
                            <input type="hidden" name="tour_prive" value="0">
                            <input type="checkbox" class="form-check-input" id="tour_prive" name="tour_prive" value="1" {{ old('tour_prive', $guide->tour_prive) ? 'checked' : '' }}>
                            <label class="form-check-label" for="tour_prive">Tour Privé</label>
                        </div>

                        <div class="mb-3">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <input type="text" class="form-control" id="telephone" name="telephone" value="{{ old('telephone', $guide->telephone) }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $guide->email) }}">
                        </div>
                        <div class="mb-3">
                            <label for="site_web" class="form-label">Site Web</label>
                            <input type="url" class="form-control" id="site_web" name="site_web" value="{{ old('site_web', $guide->site_web) }}">
                        </div>
                        <div class="mb-3">
                            <label for="photo_url" class="form-label">Photo URL</label>
                            <input type="url" class="form-control" id="photo_url" name="photo_url" value="{{ old('photo_url', $guide->photo_url) }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
