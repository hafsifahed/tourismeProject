@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Ajouter Location Transport'])
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

                    <form action="{{ route('location-transport.store') }}" method="POST">
                        @csrf

                        <!-- Transport -->
                        <div class="mb-3">
                            <label for="id_transport" class="form-label">Transport</label>
                            <select class="form-select @error('id_transport') is-invalid @enderror" id="id_transport" name="id_transport" required>
                                <option value="">Sélectionner un transport</option>
                                @foreach ($transports as $transport)
                                    <option value="{{ $transport->id_transport }}" {{ old('id_transport') == $transport->id_transport ? 'selected' : '' }}>
                                        {{ $transport->type }} - {{ $transport->model }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_transport')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Utilisateur -->
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Utilisateur</label>
                            <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                                <option value="">Sélectionner un utilisateur</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Date de Début -->
                        <div class="mb-3">
                            <label for="date_debut" class="form-label">Date de Début</label>
                            <input type="date" class="form-control @error('date_debut') is-invalid @enderror" id="date_debut" name="date_debut" value="{{ old('date_debut') }}" required>
                            @error('date_debut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Date de Fin -->
                        <div class="mb-3">
                            <label for="date_fin" class="form-label">Date de Fin</label>
                            <input type="date" class="form-control @error('date_fin') is-invalid @enderror" id="date_fin" name="date_fin" value="{{ old('date_fin') }}" required>
                            @error('date_fin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">Sélectionner un status</option>
                                <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                                <option value="Cancelled" {{ old('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Prix Total -->
                        <div class="mb-3">
                            <label for="prix_total" class="form-label">Prix Total (en Dinars)</label>
                            <input type="number" class="form-control @error('prix_total') is-invalid @enderror" id="prix_total" name="prix_total" step="0.01" min="0" value="{{ old('prix_total') }}" required>
                            @error('prix_total')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Ajouter Location</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
