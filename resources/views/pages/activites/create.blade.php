@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Ajouter Activité'])
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

                <form action="{{ route('activites.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" required placeholder="Entrez le nom de l'activité">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" required placeholder="Entrez une description de l'activité"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>

                    <div class="mb-3">
                        <label for="lieu" class="form-label">Lieu</label>
                        <input type="text" class="form-control" id="lieu" name="lieu" required placeholder="Entrez le lieu de l'activité">
                    </div>




                    <!-- Submit button -->
                    <button type='submit' class='btn btn-success'>Créer l'Activité</button>
                </form>

                <!-- Back button -->
                <a href="{{ route('activites.list') }}" class="btn btn-secondary mt-3">Retour à la liste</a>
            </div>
        </div>
    </div>
</div>
@endsection