@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Éditer Guide Local'])

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

                    <form action="{{ route('typetour.update', $type->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Utiliser la méthode PUT pour la mise à jour -->

                        <div class="mb-3">
                            <label for="nom_tour" class="form-label">Nom du type de tour</label>
                            <input type="text" class="form-control" id="nom_tour" name="nom_tour" value="{{ old('nom_tour', $type->nom) }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
