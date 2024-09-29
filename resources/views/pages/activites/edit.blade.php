@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Modifier Activité'])

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

                    <form action="{{ route('activites.update', $activite->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $activite->nom) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" required>{{ old('description', $activite->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $activite->date) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="lieu" class="form-label">Lieu</label>
                            <input type="text" class="form-control" id="lieu" name="lieu" value="{{ old('lieu', $activite->lieu) }}" required>
                        </div>

                        <!-- Bouton de soumission -->
                        <button type="submit" class="btn btn-primary">Mettre à jour l'Activité</button>
                    </form>

                    <!-- Lien de retour -->
                    <a href="{{ route('activites.list') }}" class="btn btn-secondary mt-3">Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>
@endsection
