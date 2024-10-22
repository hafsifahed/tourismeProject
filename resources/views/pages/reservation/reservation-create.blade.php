@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Ajouter Réservation de Tour'])

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

                    <form action="{{ route('reservationtour.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="guide_local" class="form-label">Guide Local</label>
                            <select class="form-select" id="guide_local" name="guide_local" required>
                                <option value="" disabled selected>Sélectionner un guide</option>
                                @foreach ($guides as $guide)
                                    <option value="{{ $guide->id }}">{{ $guide->nom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="utilisateur" class="form-label">Utilisateur</label>
                            <select class="form-select" id="utilisateur" name="utilisateur" required>
                                <option value="" disabled selected>Sélectionner un utilisateur</option>
                                @foreach ($utilisateur as $utilisateur)
                                    <option value="{{ $utilisateur->id }}">{{ $utilisateur->username }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="informations" class="form-label">Informations</label>
                            <textarea class="form-control" id="informations" name="informations" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
