@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Ajouter Transport'])
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

                    <form action="{{ route('transport.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Type -->
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" name="type" value="{{ old('type') }}" required>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Model -->
                        <div class="mb-3">
                            <label for="model" class="form-label">Model</label>
                            <select class="form-select @error('model') is-invalid @enderror" id="model" name="model" required>
                                <option value="">Sélectionner un Model</option>
                                <option value="Velo" {{ old('model') == 'Velo' ? 'selected' : '' }}>Velo</option>
                                <option value="Moto" {{ old('model') == 'Moto' ? 'selected' : '' }}>Moto</option>
                                <option value="Trotinette" {{ old('model') == 'Trotinette' ? 'selected' : '' }}>Trotinette</option>
                            </select>
                            @error('model')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">Sélectionner un status</option>
                                <option value="Available" {{ old('status') == 'Available' ? 'selected' : '' }}>Available</option>
                                <option value="Not Available" {{ old('status') == 'Not Available' ? 'selected' : '' }}>Not Available</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Prix/Heure -->
                        <div class="mb-3">
                            <label for="prix_heure" class="form-label">Prix/Heure</label>
                            <input type="number" class="form-control @error('prix_heure') is-invalid @enderror" id="prix_heure" name="prix_heure" step="0.01" min="0" value="{{ old('prix_heure') }}" required>
                            @error('prix_heure')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Batterie -->
                        <div class="mb-3">
                            <label for="battrie" class="form-label">Batterie (%)</label>
                            <input type="number" class="form-control @error('battrie') is-invalid @enderror" id="battrie" name="battrie" min="0" max="100" value="{{ old('battrie') }}" required>
                            @error('battrie')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Lieux de Location -->
                        <div class="mb-3">
                            <label for="lieux_location" class="form-label">Lieux de Location</label>
                            <input type="text" class="form-control @error('lieux_location') is-invalid @enderror" id="lieux_location" name="lieux_location" value="{{ old('lieux_location') }}" required>
                            @error('lieux_location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image URL -->
                        @csrf
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
