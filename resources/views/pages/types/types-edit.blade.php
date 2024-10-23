@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Éditer Type de Tour'])

    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header bg-gradient-primary text-white">
                    <h4 class="mb-0">Éditer le Type de Tour</h4>
                </div>

                <div class="card-body px-4 pt-4 pb-4">
                    <!-- Error message display -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form for editing tour type -->
                    <form action="{{ route('typetour.update', $type->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Use PUT method for updates -->

                        <!-- Nom du type de tour -->
                        <div class="mb-3">
                            <label for="nom_tour" class="form-label">Nom du type de tour <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nom_tour') is-invalid @enderror" id="nom_tour" name="nom_tour" value="{{ old('nom_tour', $type->nom_tour) }}" required>
                            @error('nom_tour')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Submit button -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                            <a href="{{ route('typetour.list') }}" class="btn btn-secondary ms-2">Retour à la liste</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
