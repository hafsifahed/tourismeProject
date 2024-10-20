@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Modifier Réservation'])

    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">

                    <h2>Modifier la Réservation</h2>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="activite_id" class="form-label">Activité</label>
                            <select class="form-select" id="activite_id" name="activite_id" >
                                @foreach ($activites as $activite)
                                    <option value="{{ $activite->id }}" {{ $reservation->activite_id == $activite->id ? 'selected' : '' }}>
                                        {{ $activite->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nombre_places" class="form-label">Nombre de Places</label>
                            <input type="number" class="form-control" id="nombre_places" name="nombre_places" value="{{ $reservation->nombre_places }}"  >
                        </div>

                        <button type='submit' class='btn btn-success'>Mettre à Jour la Réservation</button>
                    </form>

                    <a href="{{ route('reservations.list') }}" class='btn btn-secondary mt-3'>Retour à la liste</a>

                </div>
            </div>
        </div>
    </div>
@endsection