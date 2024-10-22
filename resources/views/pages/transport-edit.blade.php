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

                    <form action="{{ route('transport.update', $transport->id_transport) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Use PUT method for updating -->

                        <div class="mb-3">
                            <label for="nom" class="form-label">Type</label>
                            <input type="text" class="form-control" id="type" name="type" value="{{ old('type', $transport->type) }}" required   >
                        </div>

                        <label for="type_cuisine" class="form-label">Model</label>
                        <select class="form-select" id="model" name="model"    >
                            <option >Sélectionner un Model</option>
                            <option value="Velo" value="{{ old('model', $transport->model) }}" required >Velo</option>
                            <option value="Moto" value="{{ old('model', $transport->model) }}" required >Moto</option>
                            <option value="Trotinette" value="{{ old('model', $transport->model) }}" required >Trotinette</option>


                        </select>
                        <div class="mb-3">
                            <label for="type_cuisine" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="">Sélectionner un status</option>
                                <option value="Available">Available</option>
                                <option value="Not Available">Not Availble</option>

                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="prix_heure" class="form-label">Prix_Heure</label>
                            <input type="number" class="form-control" id="prix_heure" value="{{ old('prix_heure', $transport->prix_heure) }}" required name="prix_heure" step="0.01" min="0" placeholder="Enter price per hour">
                        </div>
                        <div class="mb-3">
                            <label for="telephone" class="form-label">Batterie</label>
                            <input type="text"value="{{ old('battrie', $transport->battrie) }}" class="form-control" id="battrie" name="battrie">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Lieux de Location </label>
                            <input type="text" value="{{ old('lieux_location', $transport->lieux_location) }}" class="form-control" id="lieux_location" name="lieux_location">
                        </div>



                     
                        <div class="mb-3">
                            <label for="image_url" class="form-label">Image URL</label>
                            <input type="url" class="form-control" id="image_url" name="image_url" value="{{ old('image_url', $transport->image_url) }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
