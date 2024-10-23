@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Ajouter Type de Tour'])

    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header bg-gradient-primary text-white">
                    <h4 class="mb-0">Ajouter un nouveau Type de Tour</h4>
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

                    <!-- Form for adding tour type -->
                    <form action="{{ route('typetour.store') }}" method="POST">
                        @csrf

                        <!-- Nom du type de tour -->
                        <div class="mb-3">
                            <label for="nom_tour" class="form-label">Nom du type de tour <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-map-signs"></i></span>
                                <input type="text" class="form-control @error('nom_tour') is-invalid @enderror" id="nom_tour" name="nom_tour" value="{{ old('nom_tour') }}" required placeholder="Entrez le nom du tour">
                                @error('nom_tour')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit and Back buttons -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">Ajouter</button>
                            <a href="{{ route('typetour.list') }}" class="btn btn-secondary ms-2">Retour à la liste</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
