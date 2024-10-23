@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Editer transport'])

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

                    <form action="{{ route('transport.update', $transport->id_transport) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Use PUT method for updating -->

                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <input type="text" class="form-control" id="type" name="type" value="{{ old('type', $transport->type) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="model" class="form-label">Modèle</label>
                            <select class="form-select" id="model" name="model">
                                <option value="" disabled>Select Model</option>
                                <option value="Velo" {{ old('model', $transport->model) == 'Velo' ? 'selected' : '' }}>Vélo</option>
                                <option value="Moto" {{ old('model', $transport->model) == 'Moto' ? 'selected' : '' }}>Moto</option>
                                <option value="Trotinette" {{ old('model', $transport->model) == 'Trotinette' ? 'selected' : '' }}>Trottinette</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Statut</label>
                            <select class="form-select" id="status" name="status">
                                <option value="" disabled>Select Status</option>
                                <option value="Available" {{ old('status', $transport->status) == 'Available' ? 'selected' : '' }}>Disponible</option>
                                <option value="Not Available" {{ old('status', $transport->status) == 'Not Available' ? 'selected' : '' }}>Non Disponible</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="prix_heure" class="form-label">Prix/Heure (€)</label>
                            <input type="number" class="form-control" id="prix_heure" name="prix_heure" value="{{ old('prix_heure', $transport->prix_heure) }}" required step="0.01" min="0" placeholder="Enter price per hour">
                        </div>

                        <div class="mb-3">
                            <label for="battrie" class="form-label">Batterie (%)</label>
                            <input type="number" class="form-control" id="battrie" name="battrie" value="{{ old('battrie', $transport->battrie) }}" required min="0" max="100" placeholder="Enter battery percentage">
                        </div>

                        <div class="mb-3">
                            <label for="lieux_location" class="form-label">Lieux de Location</label>
                            <input type="text" class="form-control" id="lieux_location" name="lieux_location" value="{{ old('lieux_location', $transport->lieux_location) }}" required placeholder="Enter location">
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Image (facultatif)</label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            </div>
                            @if($transport->image_url)
                                <div class="mt-2">
                                    <img src="{{ asset($transport->image_url) }}" alt="Current Image" style="max-width: 200px; max-height: 200px;">
                                </div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
