@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Détails de l\'Activité'])

    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">

                    <h2>{{ $activite->nom }}</h2>
                    <p><strong>Description:</strong> {{ $activite->description }}</p> 
                    <p><strong>Date:</strong> {{ $activite->date }}</p> 
                    <p><strong>Lieu:</strong> {{ $activite->lieu }}</p>

                    <!-- Action buttons -->
                    <div class="mt-4">
                        <a href="{{ route('activites.edit', $activite->id) }}" class='btn btn-warning'>Modifier</a>

                        <!-- Form for deletion -->
                        <form action="{{ route('activites.destroy', $activite->id) }}" method='POST' style='display:inline;'>
                            @csrf 
                            @method('DELETE') 
                            <button type='submit' class='btn btn-danger'>Supprimer</button> 
                        </form>

                        <!-- Back link -->
                        <a href="{{ route('activites.list') }}" class='btn btn-secondary mt-3'>Retour à la liste</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection